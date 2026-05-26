<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Landing Page Utama
Route::get('/', function () { 
    return view('welcome'); 
});

// Footer Pages
Route::view('/tentang', 'pages.tentang')->name('pages.tentang');
Route::view('/privasi', 'pages.privasi')->name('pages.privasi');
Route::view('/syarat', 'pages.syarat')->name('pages.syarat');
Route::view('/kontak', 'pages.kontak')->name('pages.kontak');

// Rute Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Rute Terotentikasi (Wajib Login)
Route::middleware('auth')->group(function () {
    
    // 1. USE CASE MAHASISWA (Pelapor)
    Route::middleware('can:access-student')->group(function () {
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
        Route::view('/complaints/create', 'complaints.create')->name('complaints.create');
        Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    });

    // 2. USE CASE SATGAS (Verifikator & Eksekutor - SANG DEKRIKTOR)
    Route::middleware('can:access-satgas')->group(function () {
        Route::get('/satgas/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/satgas/complaints/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::patch('/satgas/complaints/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.update_status');
        Route::get('/satgas/files/{fileId}/download', [AdminController::class, 'downloadFile'])->name('admin.download_file');
    });

// 3. USE CASE ADMIN (Hanya Kelola Akun & Performa)
    Route::middleware('can:access-admin')->group(function () {
        Route::get('/admin/management', function() {
            // Kita ambil data semua user dengan role 'satgas' dan 'student' agar daftarnya dinamis
            $users = \App\Models\User::whereIn('role', ['satgas', 'student'])->get();
            return view('admin.management', compact('users'));
        })->name('admin.management');

        // Tambahkan rute POST ini untuk memproses pembuatan akun Satgas baru
        Route::post('/admin/create-satgas', [AdminController::class, 'createSatgas'])->name('admin.create_satgas');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Rute Publik Pelacakan Anonim
Route::get('/track', function() { return view('complaints.track'); })->name('complaints.track_form');
Route::post('/track', [ComplaintController::class, 'trackStatus'])->name('complaints.track_process');