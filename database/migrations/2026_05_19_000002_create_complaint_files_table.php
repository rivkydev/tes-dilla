<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaint_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained('complaints')->onDelete('cascade');
            $table->string('storage_path');
            $table->string('file_hash', 64); // SHA-256 integrity check
            
            // Field Enkripsi per file
            $table->text('encrypted_aes_key');
            $table->string('aes_iv', 255);
            $table->string('aes_auth_tag', 255);
            $table->text('encrypted_metadata'); // Nama & mime type asli
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaint_files');
    }
};