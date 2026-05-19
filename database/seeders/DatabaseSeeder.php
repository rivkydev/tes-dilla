<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat Akun Admin Utama
        // Karena Admin tidak punya NIM publik, kita gunakan string identitas admin yang di-hash
        User::create([
            'role'            => 'admin',
            'nim_hash'        => hash('sha256', 'ADMIN_UTAMA'), 
            'password'        => Hash::make('AdminBikiniBottom2026!'), // Password akun admin Anda
            'unlock_pin_hash' => Hash::make('123456'), // PIN 2FA enkripsi pembuka berkas NIM Mahasiswa
        ]);
    }
}