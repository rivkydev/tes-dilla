<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * LOGIKA PROSES REGISTRASI MAHASISWA
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

        // 4. Otomatis login setelah berhasil registrasi dan arahkan ke dashboard pengaduan
        Auth::login($user);

        return redirect()->route('complaints.index')->with('success', 'Registrasi berhasil! Anda otomatis masuk ke sistem.');
    }

    /**
     * LOGIKA PROSES LOGIN MAHASISWA & ADMIN
     */
    public function login(LoginRequest $request)
    {
        // 1. Ambil NIM inputan dan hitung SHA-256 Blind Index-nya
        $nimHash = hash('sha256', $request->nim);

        // 2. Cari data user berdasarkan nim_hash tersebut
        $user = User::where('nim_hash', $nimHash)->first();

        // 3. Jika user ditemukan dan password-nya cocok (Bcrypt Check)
        if ($user && Hash::check($request->password, $user->password)) {
            // Regenerasi session untuk mencegah serangan Session Fixation
            $request->session()->regenerate();
            
            Auth::login($user);

            // Jika yang login adalah admin, arahkan ke dashboard admin panel
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
            }

            return redirect()->route('complaints.index')->with('success', 'Login Berhasil!');
        }

        // 4. Jika gagal, kembalikan pesan error demi keamanan (tanpa membocorkan mana yang salah antara NIM atau Password)
        throw ValidationException::withMessages([
            'nim' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
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

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}