<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class FileEncryptionService
{
    protected string $publicKeyPath;
    protected string $privateKeyPath;
    protected string $passphrase;

    public function __construct()
    {
        $this->publicKeyPath = base_path(env('RSA_PUBLIC_KEY_PATH', 'storage/keys/public.pem'));
        $this->privateKeyPath = base_path(env('RSA_PRIVATE_KEY_PATH', 'storage/keys/private.pem'));
        $this->passphrase = env('RSA_PRIVATE_KEY_PASSPHRASE');
    }

    /**
     * ENKRIPSI FILE BINER (AES-256-GCM + RSA-2048)
     * Membaca file plaintext, mengenkripsinya, lalu menyimpannya ke folder private.
     * * @param string $sourcePath Path file asli (sementara dari request upload)
     * @param string $destPath Path tujuan penyimpanan file terenkripsi
     * @return array Metadata kriptografi untuk disimpan ke database
     */
    public function encryptFile(string $sourcePath, string $destPath): array
    {
        try {
            if (!File::exists($sourcePath)) {
                throw new Exception("File sumber tidak ditemukan pada path: {$sourcePath}");
            }

            // 1. Hitung SHA-256 Integrity Hash dari file asli (Plaintext) sebelum dienkripsi
            // Ini digunakan untuk verifikasi pasca-dekripsi agar file dipastikan tidak korup
            $fileHash = hash_file('sha256', $sourcePath);

            // 2. Membaca konten biner file asli
            $fileData = File::get($sourcePath);

            // 3. Generate kunci AES per file secara acak & IV (12-bytes untuk GCM)
            $aesKey = random_bytes(32);
            $iv = random_bytes(12);
            $tag = ''; // Akan diisi otomatis oleh OpenSSL

            // 4. Enkripsi biner file menggunakan AES-256-GCM
            $ciphertext = openssl_encrypt(
                $fileData,
                'aes-256-gcm',
                $aesKey,
                OPENSSL_RAW_DATA,
                $iv,
                $tag,
                '',
                16
            );

            if ($ciphertext === false) {
                throw new Exception("Gagal mengenkripsi biner file.");
            }

            // 5. Pastikan direktori tujuan ada, lalu simpan biner terenkripsi
            $destDirectory = dirname($destPath);
            if (!File::isDirectory($destDirectory)) {
                File::makeDirectory($destDirectory, 0700, true, true);
            }
            File::put($destPath, $ciphertext);

            // 6. Enkripsi kunci AES file menggunakan Public Key RSA
            $publicKeyContent = file_get_contents($this->publicKeyPath);
            $publicKeyResource = openssl_pkey_get_public($publicKeyContent);
            if (!$publicKeyResource) {
                throw new Exception("Public Key RSA tidak valid atau tidak ditemukan.");
            }

            $encryptedAesKey = '';
            $rsaSuccess = openssl_public_encrypt(
                $aesKey,
                $encryptedAesKey,
                $publicKeyResource,
                OPENSSL_PKCS1_OAEP_PADDING
            );

            if (!$rsaSuccess) {
                throw new Exception("Gagal mengenkripsi kunci AES dengan Public Key RSA.");
            }

            // 7. Kembalikan paket payload untuk migrasi record database
            return [
                'file_hash'         => $fileHash,
                'encrypted_aes_key' => base64_encode($encryptedAesKey),
                'aes_iv'            => base64_encode($iv),
                'aes_auth_tag'      => base64_encode($tag),
            ];

        } catch (Exception $e) {
            Log::error("Gagal melakukan enkripsi file: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * DEKRIPSI FILE BINER
     * Membaca file terenkripsi, memulihkannya, lalu mengembalikan biner plaintext-nya.
     * * @return string Konten biner asli file (untuk di-stream langsung ke browser admin)
     */
    public function decryptFile(string $encryptedFilePath, string $base64EncryptedAesKey, string $base64Iv, string $base64AuthTag, string $expectedHash): string
    {
        try {
            if (!File::exists($encryptedFilePath)) {
                throw new Exception("File terenkripsi tidak ditemukan pada disk.");
            }

            // Decode komponen kriptografi dari Base64
            $ciphertext = File::get($encryptedFilePath);
            $encryptedAesKey = base64_decode($base64EncryptedAesKey);
            $iv = base64_decode($base64Iv);
            $tag = base64_decode($base64AuthTag);

            // 1. Ambil Private Key RSA dan pecah proteksi Passphrase-nya
            $privateKeyContent = file_get_contents($this->privateKeyPath);
            $privateKeyResource = openssl_pkey_get_private($privateKeyContent, $this->passphrase);

            if (!$privateKeyResource) {
                throw new Exception("Private Key gagal dimuat. Periksa passphrase .env Anda.");
            }

            // 2. Dekripsi kunci AES file dengan RSA Private Key
            $aesKey = '';
            $rsaSuccess = openssl_private_decrypt(
                $encryptedAesKey,
                $aesKey,
                $privateKeyResource,
                OPENSSL_PKCS1_OAEP_PADDING
            );

            if (!$rsaSuccess || empty($aesKey)) {
                throw new Exception("Gagal mendekripsi kunci AES menggunakan RSA. Private key mungkin salah atau data terenkripsi korup.");
            }

            // 3. Dekripsi biner file utama dengan kunci AES hasil pemulihan
            $decryptedData = openssl_decrypt(
                $ciphertext,
                'aes-256-gcm',
                $aesKey,
                OPENSSL_RAW_DATA,
                $iv,
                $tag
            );

            if ($decryptedData === false) {
                throw new Exception("Gagal mendekripsi biner file. Autentikasi integritas data (GCM Tag) gagal.");
            }

            // 4. File Integrity Check (Improvement #4)
            // Hitung hash biner hasil dekripsi dan cocokkan dengan hash awal dari database
            $actualHash = hash('sha256', $decryptedData);
            if ($actualHash !== $expectedHash) {
                throw new Exception("Bahaya: Integritas file rusak! Hash hasil dekripsi tidak cocok dengan data asli.");
            }

            return $decryptedData;

        } catch (Exception $e) {
            Log::error("Gagal melakukan dekripsi file: " . $e->getMessage());
            throw $e;
        }
    }
}