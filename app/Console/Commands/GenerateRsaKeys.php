<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateRsaKeys extends Command
{
    /**
     * Nama dan format perintah di terminal.
     *
     * @var string
     */
    protected $signature = 'keys:generate {--force : Memaksa menimpa kunci jika sudah ada}';

    /**
     * Deskripsi perintah saat melihat daftar php artisan.
     *
     * @var string
     */
    protected $description = 'Meng-generate pasangan kunci RSA-2048 untuk sistem Hybrid Enkripsi';

    /**
     * Eksekusi perintah logika utama.
     */
    public function handle()
    {
        // Mengambil konfigurasi path dan passphrase dari file .env
        $publicKeyPath = base_path(env('RSA_PUBLIC_KEY_PATH', 'storage/keys/public.pem'));
        $privateKeyPath = base_path(env('RSA_PRIVATE_KEY_PATH', 'storage/keys/private.pem'));
        $passphrase = env('RSA_PRIVATE_KEY_PASSPHRASE');

        if (empty($passphrase)) {
            $this->error('GAGAL: Variabel RSA_PRIVATE_KEY_PASSPHRASE belum diatur di file .env!');
            return Command::FAILURE;
        }

        // Cek validasi proteksi timpa file secara tidak sengaja
        if ((File::exists($publicKeyPath) || File::exists($privateKeyPath)) && !$this->option('force')) {
            $this->warn('PERINGATAN: Pasangan kunci RSA sudah ada di folder storage/keys/.');
            $this->line('Gunakan perintah "php artisan keys:generate --force" jika ingin menimpanya.');
            return Command::FAILURE;
        }

        // Pastikan folder penampung storage/keys/ tersedia
        $directory = dirname($publicKeyPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0700, true, true);
        }

        $this->info('Sedang memproses enkapsulasi generasi RSA-2048 key pair...');

        // Konfigurasi algoritma standard industri untuk RSA
        $config = [
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ];

        // 1. Inisiasi pembuatan private key baru
        $rsaKeyResource = openssl_pkey_new($config);

        if (!$rsaKeyResource) {
            $this->error('GAGAL: Tidak dapat meng-generate kunci. Pastikan ekstensi OpenSSL aktif di PHP Anda.');
            return Command::FAILURE;
        }

        // 2. Ekstrak Private Key dengan proteksi Passphrase dari .env
        openssl_pkey_export($rsaKeyResource, $privateKey, $passphrase, $config);

        // 3. Ekstrak Public Key pasangannya
        $keyDetails = openssl_pkey_get_details($rsaKeyResource);
        $publicKey = $keyDetails["key"];

        // 4. Tulis string kunci ke dalam file fisik di storage/keys/
        File::put($privateKeyPath, $privateKey);
        File::put($publicKeyPath, $publicKey);

        // 5. Atur permission file demi proteksi lokal operating system
        @chmod($privateKeyPath, 0600); // Hanya system-owner yang bisa membaca data ini
        @chmod($publicKeyPath, 0644);

        $this->info('SUKSES: Sepasang kunci RSA sukses dibuat dan diamankan!');
        $this->line("Public Key  : {$publicKeyPath}");
        $this->line("Private Key : {$privateKeyPath}");

        return Command::SUCCESS;
    }
}