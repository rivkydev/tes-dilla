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
        Schema::table('complaints', function (Blueprint $table) {
            $table->text('encrypted_identity_aes_key')->nullable()->after('encrypted_identity');
            $table->string('identity_aes_iv')->nullable()->after('encrypted_identity_aes_key');
            $table->string('identity_aes_auth_tag')->nullable()->after('identity_aes_iv');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn([
                'encrypted_identity_aes_key',
                'identity_aes_iv',
                'identity_aes_auth_tag',
            ]);
        });
    }
};
