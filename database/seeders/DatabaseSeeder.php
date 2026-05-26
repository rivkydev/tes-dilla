<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Pengelola IT (TIDAK BISA DEKRIPSI DATA)
        User::create([
            'role'     => 'admin',
            'nim_hash' => hash('sha256', 'ADMIN_IT'), 
            'password' => Hash::make('AdminKampus2026!'),
        ]);

        // 2. Akun Satgas Penyelidik (YANG PEGANG KUNCI PRIVATE UNTUK DEKRIPSI)
        User::create([
            'role'            => 'satgas',
            'nim_hash'        => hash('sha256', 'SATGAS_BERWENANG'), 
            'password'        => Hash::make('SatgasAman2026!'),
            'unlock_pin_hash' => Hash::make('123456'), // PIN 2FA Penyingkap NIM Pelapor
        ]);
    }
}