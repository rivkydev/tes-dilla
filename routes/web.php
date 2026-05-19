<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Rute Guest (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Rute Auth (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    
    // --- RUTE MAHASISWA ---
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::view('/complaints/create', 'complaints.create')->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    
    // --- RUTE PANEL ADMIN (Menggunakan alias 'admin' dari Kernel.php) ---
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/complaints/{id}', [AdminController::class, 'show'])->name('admin.show');
        Route::patch('/admin/complaints/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.update_status');
        Route::get('/admin/files/{fileId}/download', [AdminController::class, 'downloadFile'])->name('admin.download_file');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Rute Publik untuk pelacakan menggunakan Kode Resi/UUID (Bisa diakses tanpa login)
Route::get('/track', function() { return view('complaints.track'); })->name('complaints.track_form');
Route::post('/track', [ComplaintController::class, 'trackStatus'])->name('complaints.track_process');

// Default fallback route ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});