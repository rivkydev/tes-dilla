<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use SoftDeletes; // Dukungan penghapusan aman (Soft Delete)

    protected $fillable = [
        'user_id',
        'tracking_token',
        'category',
        'status',
        'encrypted_aes_key',
        'aes_iv',
        'aes_auth_tag',
        'encrypted_identity',
        'encrypted_identity_aes_key',
        'identity_aes_iv',
        'identity_aes_auth_tag',
        'encrypted_content'
    ];

    public function files(): HasMany
    {
        return $this->hasMany(ComplaintFile::class);
    }
}