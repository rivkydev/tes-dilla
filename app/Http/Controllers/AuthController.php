<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * LOGIKA PROSES REGISTRASI MAHASISWA (Blind Index Creation)
     */
    public function register(RegisterRequest $request)
    {
        // 1. Ambil NIM dari input, lalu ubah menjadi SHA-256 Blind Index Hash
        $nimHash = hash('sha256', $request->nim);

        // 2. Cek apakah NIM Hash ini sudah terdaftar sebelumnya di database
        if (User::where('nim_hash', $nimHash)->exists()) {
            throw ValidationException::withMessages([
                'nim' => 'NIM ini sudah terdaftar di dalam sistem.',
            ]);
        }

        // 3. Buat user baru dengan role 'student'
        $user = User::create([
            'role'     => 'student',
            'nim_hash' => $nimHash,
            'password' => Hash::make($request->password), // Bcrypt hashing bawaan Laravel
        ]);

        // 4. Otomatis login setelah berhasil registrasi
        Auth::login($user);

        return redirect()->route('complaints.index')->with('success', 'Registrasi berhasil! Anda otomatis masuk ke sistem.');
    }

    /**
     * PROSES AUTENTIKASI / LOGIN (Mendukung Multi-Role Student, Satgas, Admin)
     */
/**
     * PROSES AUTENTIKASI / LOGIN (Mendukung Multi-Role Student, Satgas, Admin)
     */
    public function login(Request $request)
    {
        // 1. Sesuaikan validasi agar membaca field 'nim' dari form HTML
        $request->validate([
            'nim'      => 'required|string', // Mengikuti name="nim" yang ada di blade
            'password' => 'required|string',
        ]);

        // 2. Ubah input nim menjadi SHA-256 untuk pencocokan Blind Index di database
        $hashedIdentity = hash('sha256', $request->nim);

        // 3. Cari user berdasarkan hash tersebut
        $user = User::where('nim_hash', $hashedIdentity)->first();

        // 4. Validasi keberadaan user dan kecocokan password
        if ($user && Hash::check($request->password, $user->password)) {
            
            // Regenerate session untuk mencegah serangan Session Fixation
            $request->session()->regenerate();
            Auth::login($user);

            // =================================================================
            // PENGALIHAN ALUR BERDASARKAN ROLE (ZERO-TRUST ARCHITECTURE)
            // =================================================================
            
            // Aktor Satgas: Dashboard Penyelidikan (Pegang Kunci Privat Dekripsi)
            if ($user->role === 'satgas') {
                return redirect()->route('admin.dashboard')->with('success', 'Otorisasi Berhasil. Selamat bekerja Satgas Penyelidik!');
            }
            
            // Aktor Admin: Panel Manajemen Infrastruktur IT (Tanpa Akses Dokumen)
            if ($user->role === 'admin') {
                return redirect()->route('admin.management')->with('success', 'Otorisasi Berhasil. Selamat datang Admin Pengelola IT!');
            }

            // Aktor Mahasiswa / Student (Default)
            return redirect()->route('complaints.index')->with('success', 'Selamat datang kembali!');
        }

        // Jika kombinasi salah, kembalikan dengan pesan eror standar keamanan (Generic Error)
        return redirect()->back()->withInput()->withErrors([
            'login_error' => 'Identitas atau password yang Anda masukkan salah.'
        ]);
    }

    /**
     * LOGIKA LOGOUT SISTEM
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan token session saat ini
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}