<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Role: student atau admin
            $table->enum('role', ['student', 'satgas', 'admin'])->default('student');
            
            // Menggunakan hash NIM untuk login agar NIM tidak tersimpan plaintext di database
            $table->string('nim_hash')->unique()->nullable();
            
            $table->string('password');
            $table->string('unlock_pin_hash')->nullable(); // PIN 2FA Admin
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};