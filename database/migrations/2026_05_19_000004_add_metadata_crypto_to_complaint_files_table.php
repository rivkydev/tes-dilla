<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaint_files', function (Blueprint $table) {
            $table->text('metadata_encrypted_aes_key')->nullable()->after('encrypted_aes_key');
            $table->string('metadata_aes_iv')->nullable()->after('aes_iv');
            $table->string('metadata_aes_auth_tag')->nullable()->after('aes_auth_tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_files', function (Blueprint $table) {
            $table->dropColumn(['metadata_encrypted_aes_key', 'metadata_aes_iv', 'metadata_aes_auth_tag']);
        });
    }
};
