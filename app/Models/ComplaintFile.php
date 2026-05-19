<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintFile extends Model
{
    protected $fillable = [
        'complaint_id',
        'storage_path',
        'file_hash',
        'encrypted_aes_key',
        'aes_iv',
        'aes_auth_tag',
        'encrypted_metadata',
        'metadata_encrypted_aes_key',
        'metadata_aes_iv',
        'metadata_aes_auth_tag'
    ];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }
}