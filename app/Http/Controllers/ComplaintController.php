<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintFile;
use App\Http\Requests\StoreComplaintRequest;
use App\Services\EncryptionService;
use App\Services\FileEncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    protected EncryptionService $encryptionService;
    protected FileEncryptionService $fileEncryptionService;

    // Suntikkan kedua layanan enkripsi kita melalui constructor
    public function __construct(EncryptionService $encryptionService, FileEncryptionService $fileEncryptionService)
    {
        $this->encryptionService = $encryptionService;
        $this->fileEncryptionService = $fileEncryptionService;
    }

    /**
     * TAMPILKAN DAFTAR PENGADUAN SAYA (MAHASISWA)
     */
    public function index()
    {
        // Mengambil riwayat pengaduan milik mahasiswa yang sedang login saat ini
        $complaints = Complaint::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('complaints.index', compact('complaints'));
    }

    /**
     * PROSES SUBMIT PENGADUAN BARU (IMPLEMENTASI FLOWCHART ENKRIPSI)
     */
    public function store(StoreComplaintRequest $request)
    {
        // Mulai transaksi database untuk menjamin integritas data (jika enkripsi file gagal, teks dibatalkan)
        DB::beginTransaction();

        try {
            // 1. Satukan data identitas mahasiswa (Plaintext) menjadi format JSON string
            // Kita mengambil data NIM langsung dari user yang login demi validitas
            $identityPayload = json_encode([
                'nim'     => $request->user()->nim_hash, // Blind index reference
                'name'    => htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8'),
                'contact' => htmlspecialchars($request->contact, ENT_QUOTES, 'UTF-8'),
            ]);

            // 2. Bersihkan bodi teks laporan dari XSS menggunakan htmlspecialchars
            $cleanContent = htmlspecialchars($request->content, ENT_QUOTES, 'UTF-8');

            // 3. ENKRIPSI DATA UTAMA (Menggunakan Kunci AES Unik yang dibungkus RSA)
            // Kita mengenkripsi isi konten bodi utama
            $encryptedPayload = $this->encryptionService->encryptData($cleanContent);

            // Kita juga enkripsi paket data identitas pelapor menggunakan mesin yang sama
            // Namun untuk fleksibilitas skema database, kita pisahkan ciphertext-nya
            $encryptedIdentityData = $this->encryptionService->encryptData($identityPayload);

            // 4. Generate UUID Pelacakan Anonim (Improvement #1)
            $trackingToken = (string) Str::uuid();

            // 5. Simpan Record Induk Pengaduan ke Database
            $complaint = Complaint::create([
                'user_id'                     => Auth::id(),
                'tracking_token'              => $trackingToken,
                'category'                    => $request->category,
                'status'                      => 'Pending',
                'encrypted_aes_key'           => $encryptedPayload['encrypted_aes_key'],
                'aes_iv'                      => $encryptedPayload['aes_iv'],
                'aes_auth_tag'                => $encryptedPayload['aes_auth_tag'],
                'encrypted_identity'          => $encryptedIdentityData['ciphertext'], // Ciphertext identitas
                'encrypted_identity_aes_key'  => $encryptedIdentityData['encrypted_aes_key'],
                'identity_aes_iv'             => $encryptedIdentityData['aes_iv'],
                'identity_aes_auth_tag'       => $encryptedIdentityData['aes_auth_tag'],
                'encrypted_content'           => $encryptedPayload['ciphertext'],  // Ciphertext isi aduan
            ]);

            // 6. PROSES ENKRIPSI FILE PENDUKUNG (Jika Ada)
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Ambil nama asli dan tipe mime file untuk dienkripsi sebagai metadata
                    $metadataPayload = json_encode([
                        'filename'  => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                    ]);

                    // Ambil bodi rahasia metadata terenkripsi
                    $encryptedMetadata = $this->encryptionService->encryptData($metadataPayload);

                    // Buat nama file acak baru untuk disimpan di disk lokal private
                    $secureFilename = Str::random(40) . '.enc';
                    $secureStoragePath = 'storage/app/private/complaints/' . $secureFilename;

                    // Eksekusi enkripsi biner file (AES-256-GCM + RSA-2048)
                    $fileCryptoResult = $this->fileEncryptionService->encryptFile(
                        $file->getRealPath(),
                        base_path($secureStoragePath)
                    );

                    // Simpan record file terenkripsi ke database
                    ComplaintFile::create([
                        'complaint_id'                => $complaint->id,
                        'storage_path'                => $secureStoragePath,
                        'file_hash'                   => $fileCryptoResult['file_hash'], // SHA-256 integrity check
                        // AES params untuk enkripsi biner file
                        'encrypted_aes_key'           => $fileCryptoResult['encrypted_aes_key'],
                        'aes_iv'                      => $fileCryptoResult['aes_iv'],
                        'aes_auth_tag'                => $fileCryptoResult['aes_auth_tag'],
                        // Metadata terenkripsi (ciphertext + parameter kripto terpisah)
                        'encrypted_metadata'          => $encryptedMetadata['ciphertext'],
                        'metadata_encrypted_aes_key'  => $encryptedMetadata['encrypted_aes_key'],
                        'metadata_aes_iv'             => $encryptedMetadata['aes_iv'],
                        'metadata_aes_auth_tag'       => $encryptedMetadata['aes_auth_tag'],
                    ]);
                }
            }

            // Jika semua alur enkripsi tanpa celah cacat, komit ke database
            DB::commit();

            return redirect()->route('complaints.index')->with([
                'success' => 'Pengaduan Anda berhasil dikirim dengan sistem keamanan Hybrid Enkripsi!',
                'token'   => $trackingToken // Tampilkan token resi ini di halaman sukses mahasiswa
            ]);

        } catch (\Exception $e) {
            // Jika di tengah jalan ada kegagalan enkripsi biner, batalkan seluruh transaksi database
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'error' => 'Gagal memproses pengaduan karena gangguan enkripsi sistem: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * CEK STATUS ANONIM (Menggunakan Kode Resi Tanpa Harus Login)
     */
    public function trackStatus(Request $request)
    {
        $request->validate(['token' => 'required|uuid']);

        $complaint = Complaint::where('tracking_token', $request->token)->first();

        if (!$complaint) {
            return redirect()->back()->withErrors(['token' => 'Kode resi pelacakan tidak ditemukan.']);
        }

        // Kembalikan status pengaduan (Hanya status dan kategori yang bersifat plaintext umum)
        return view('complaints.track_result', compact('complaint'));
    }
}