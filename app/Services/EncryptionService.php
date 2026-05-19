<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class EncryptionService
{
    protected string $publicKeyPath;
    protected string $privateKeyPath;
    protected string $passphrase;

    /**
     * Konstruktor resmi PHP untuk inisialisasi properti path kunci dari .env
     */
    public function __construct()
    {
        $this->publicKeyPath = base_path(env('RSA_PUBLIC_KEY_PATH', 'storage/keys/public.pem'));
        $this->privateKeyPath = base_path(env('RSA_PRIVATE_KEY_PATH', 'storage/keys/private.pem'));
        $this->passphrase = env('RSA_PRIVATE_KEY_PASSPHRASE');
    }

    /**
     * Skenario 1: ENKRIPSI HYBRID (Mengikuti Flowchart Enkripsi Proposal)
     * Mengenkripsi data plaintext dan mengembalikan paket kriptografi untuk disimpan di DB.
     */
    public function encryptData(string $plainText): array
    {
        try {
            // 1. Generate Kunci AES-256 bit (32 bytes) & IV (12 bytes untuk GCM) secara acak per rekord
            $aesKey = random_bytes(32);
            $iv = random_bytes(12);
            $tag = ''; // Kosong, akan diisi otomatis oleh openssl_encrypt untuk GCM tag

            // 2. Enkripsi data plaintext dengan AES-256-GCM
            $ciphertext = openssl_encrypt(
                $plainText,
                'aes-256-gcm',
                $aesKey,
                OPENSSL_RAW_DATA,
                $iv,
                $tag,
                '', // AAD kosong
                16  // Ukuran auth tag 16 bytes
            );

            if ($ciphertext === false) {
                throw new Exception('Gagal melakukan enkripsi simetris AES.');
            }

            // 3. Ambil Public Key RSA untuk mengenkripsi Kunci AES
            $publicKeyContent = file_get_contents($this->publicKeyPath);
            $publicKeyResource = openssl_pkey_get_public($publicKeyContent);

            if (!$publicKeyResource) {
                throw new Exception('Public Key RSA tidak valid atau tidak ditemukan.');
            }

            // 4. Enkripsi Kunci AES menggunakan RSA-2048-OAEP (Padding Aman)
            $encryptedAesKey = '';
            $rsaSuccess = openssl_public_encrypt(
                $aesKey,
                $encryptedAesKey,
                $publicKeyResource,
                OPENSSL_PKCS1_OAEP_PADDING
            );

            if (!$rsaSuccess) {
                throw new Exception('Gagal mengenkripsi kunci AES menggunakan RSA.');
            }

            // 5. Kembalikan semua komponen dalam bentuk Base64 encoded agar aman masuk ke database
            return [
                'encrypted_aes_key' => base64_encode($encryptedAesKey),
                'aes_iv'            => base64_encode($iv),
                'aes_auth_tag'      => base64_encode($tag),
                'ciphertext'        => base64_encode($ciphertext),
            ];

        } catch (Exception $e) {
            Log::error('Kriptografi Error pada Enkripsi: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Skenario 2: DEKRIPSI HYBRID (Mengikuti Flowchart Dekripsi Proposal)
     * Memulihkan ciphertext menjadi plaintext asli menggunakan Private Key RSA.
     */
    public function decryptData(string $base64Ciphertext, string $base64EncryptedAesKey, string $base64Iv, string $base64AuthTag): string
    {
        try {
            // Decode semua komponen kriptografi dari format Base64
            $ciphertext = base64_decode($base64Ciphertext);
            $encryptedAesKey = base64_decode($base64EncryptedAesKey);
            $iv = base64_decode($base64Iv);
            $tag = base64_decode($base64AuthTag);

            // 1. Ambil Private Key RSA dari storage
            $privateKeyContent = file_get_contents($this->privateKeyPath);
            
            // 2. Buka Private Key menggunakan Passphrase dari .env
            $privateKeyResource = openssl_pkey_get_private($privateKeyContent, $this->passphrase);

            if (!$privateKeyResource) {
                throw new Exception('Gagal memuat Private Key RSA. Passphrase salah atau file rusak.');
            }

            // 3. Dekripsi Kunci AES menggunakan RSA Private Key (OAEP Padding)
            $aesKey = '';
            $rsaSuccess = openssl_private_decrypt(
                $encryptedAesKey,
                $aesKey,
                $privateKeyResource,
                OPENSSL_PKCS1_OAEP_PADDING
            );

            if (!$rsaSuccess) {
                throw new Exception('Gagal mendekripsi kunci AES menggunakan RSA.');
            }

            // 4. Dekripsi data utama menggunakan kunci AES yang berhasil dipulihkan
            $plainText = openssl_decrypt(
                $ciphertext,
                'aes-256-gcm',
                $aesKey,
                OPENSSL_RAW_DATA,
                $iv,
                $tag
            );

            if ($plainText === false) {
                throw new Exception('Gagal mendekripsi data dengan AES-256-GCM. Autentikasi integritas data gagal.');
            }

            return $plainText;

        } catch (Exception $e) {
            Log::error('Kriptografi Error pada Dekripsi: ' . $e->getMessage());
            throw $e;
        }
    }
}