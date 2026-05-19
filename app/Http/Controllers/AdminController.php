<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintFile;
use App\Models\AuditLog;
use App\Services\EncryptionService;
use App\Services\FileEncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    protected EncryptionService $encryptionService;
    protected FileEncryptionService $fileEncryptionService;

    public function __construct(EncryptionService $encryptionService, FileEncryptionService $fileEncryptionService)
    {
        $this->encryptionService = $encryptionService;
        $this->fileEncryptionService = $fileEncryptionService;
    }

    /**
     * LOGIKA UNTUK MENGOLES AUDIT LOG SECARA AMAN (AES-256-CBC)
     */
    private function encryptAuditDetails(string $text): string
    {
        $key = base64_decode(env('AUDIT_LOG_KEY'));
        $iv = random_bytes(16);
        $ciphertext = openssl_encrypt($text, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $ciphertext);
    }

    /**
     * 1. HALAMAN UTAMA DASHBOARD ADMIN (LIST PENGADUAN)
     */
    public function dashboard()
    {
        // Mengambil semua pengaduan. Ingat, isi teks dan identitas masih berupa ciphertext di DB,
        // sehingga halaman ini hanya menampilkan metadata non-sensitif (kategori, status, tanggal, token).
        $complaints = Complaint::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('complaints'));
    }

    /**
     * 2. HALAMAN DETAIL PENGADUAN (PROSES DEKRIPSI ON-DEMAND)
     */
    public function show(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        
        try {
            // EKSEKUSI DEKRIPSI ISI LAPORAN (Ditambahkan trim agar Base64 terbaca murni)
            $decryptedContent = $this->encryptionService->decryptData(
                trim($complaint->encrypted_content),
                trim($complaint->encrypted_aes_key),
                trim($complaint->aes_iv),
                trim($complaint->aes_auth_tag)
            );

            // Dekripsi Identitas Pelapor
            $decryptedIdentityJson = $this->encryptionService->decryptData(
                trim($complaint->encrypted_identity),
                trim($complaint->encrypted_identity_aes_key ?? $complaint->encrypted_aes_key),
                trim($complaint->identity_aes_iv ?? $complaint->aes_iv),
                trim($complaint->identity_aes_auth_tag ?? $complaint->aes_auth_tag)
            );
            $identity = json_decode($decryptedIdentityJson, true);

            // Cek apakah Admin memasukkan PIN 2FA untuk unlock NIM asli (Improvement #2)
            $nimUnlocked = false;
            if ($request->has('pin')) {
                if (Hash::check($request->pin, Auth::user()->unlock_pin_hash)) {
                    $nimUnlocked = true;
                } else {
                    session()->flash('pin_error', 'PIN 2FA yang Anda masukkan salah!');
                }
            }

            // Proses Dekripsi Nama File & Mime Type untuk lampiran pendukung
            $decryptedFiles = [];
            foreach ($complaint->files as $file) {
                // Prefer metadata-specific crypto params (created at upload). Jika tidak ada, fallback ke kunci induk.
                $metaEncryptedKey = $file->metadata_encrypted_aes_key ?? $complaint->encrypted_aes_key;
                $metaIv = $file->metadata_aes_iv ?? $complaint->aes_iv;
                $metaTag = $file->metadata_aes_auth_tag ?? $complaint->aes_auth_tag;

                $decryptedMetaJson = $this->encryptionService->decryptData(
                    $file->encrypted_metadata,
                    $metaEncryptedKey,
                    $metaIv,
                    $metaTag
                );
                $meta = json_decode($decryptedMetaJson, true);
                
                $decryptedFiles[] = [
                    'id' => $file->id,
                    'filename' => $meta['filename'],
                    'mime_type' => $meta['mime_type']
                ];
            }

            // TULIS AUDIT TRAIL TERENKRIPSI (Improvement #3)
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'VIEW_COMPLAINT_DETAIL',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'encrypted_details' => $this->encryptAuditDetails("Admin membuka detail laporan ID: {$complaint->id}. Status NIM Unlock: " . ($nimUnlocked ? 'YES' : 'NO'))
            ]);

            return view('admin.show', compact('complaint', 'decryptedContent', 'identity', 'decryptedFiles', 'nimUnlocked'));

        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')->withErrors([
                'error' => 'Gagal mendekripsi dokumen. Private Key server tidak cocok atau rusak: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * 3. UPDATE STATUS PENGADUAN
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Ditolak'
        ]);

        $complaint = Complaint::findOrFail($id);
        $oldStatus = $complaint->status;
        $complaint->update(['status' => $request->status]);

        // Catat ke Audit Log
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'UPDATE_COMPLAINT_STATUS',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'encrypted_details' => $this->encryptAuditDetails("Admin mengubah status laporan ID: {$complaint->id} dari {$oldStatus} menjadi {$request->status}")
        ]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    /**
     * 4. STREAM DOWNLOAD FILE PENDUKUNG (DEKRIPSI ON-THE-FLY)
     */
    public function downloadFile(Request $request, $fileId)
    {
        $fileRecord = ComplaintFile::findOrFail($fileId);
        $complaint = $fileRecord->complaint;

        try {
            // 1. Dekripsi metadata file terlebih dahulu untuk mendapatkan nama asli file
            $metaEncryptedKey = $fileRecord->metadata_encrypted_aes_key ?? $complaint->encrypted_aes_key;
            $metaIv = $fileRecord->metadata_aes_iv ?? $complaint->aes_iv;
            $metaTag = $fileRecord->metadata_aes_auth_tag ?? $complaint->aes_auth_tag;

            $decryptedMetaJson = $this->encryptionService->decryptData(
                $fileRecord->encrypted_metadata,
                $metaEncryptedKey,
                $metaIv,
                $metaTag
            );
            $meta = json_decode($decryptedMetaJson, true);

            // 2. Dekripsi biner file utama (Melakukan SHA-256 integrity check di dalam service)
            $fileBinaryContent = $this->fileEncryptionService->decryptFile(
                base_path($fileRecord->storage_path),
                $fileRecord->encrypted_aes_key,
                $fileRecord->aes_iv,
                $fileRecord->aes_auth_tag,
                $fileRecord->file_hash // expected SHA-256 hash
            );

            // 3. Catat aksi unduh ke Audit Trail
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'DOWNLOAD_ENCRYPTED_FILE',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'encrypted_details' => $this->encryptAuditDetails("Admin mengunduh file terenkripsi: {$meta['filename']} dari laporan ID: {$complaint->id}")
            ]);

            // 4. Stream langsung konten biner ke browser tanpa membuat file plaintext fisik di storage
            return Response::make($fileBinaryContent, 200, [
                'Content-Type' => $meta['mime_type'],
                'Content-Disposition' => 'attachment; filename="' . $meta['filename'] . '"',
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Gagal mengunduh file. Integritas data rusak atau kunci salah: ' . $e->getMessage()
            ]);
        }
    }
}