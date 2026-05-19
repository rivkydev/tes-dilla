<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->uuid('tracking_token')->unique(); // Resi pengaduan
            
            $table->string('category');
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Ditolak'])->default('Pending');
            
            // --- FIELD ENKRIPSI HYBRID ---
            // --- FIELD ENKRIPSI HYBRID ---
            $table->text('encrypted_aes_key');   // Kunci AES yang dienkripsi pakai RSA
            $table->text('aes_iv');              // UBAH JADI TEXT: Menghindari distorsi biner/base64 di VARCHAR
            $table->text('aes_auth_tag');        // UBAH JADI TEXT: Menghindari kegagalan GCM Auth Tag akibat encoding

            $table->longText('encrypted_identity'); // Data NIM/Nama pelapor (AES)
            $table->longText('encrypted_content');  // Isi pengaduan (AES)
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};