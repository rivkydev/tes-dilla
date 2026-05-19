<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang diizinkan untuk pengisian massal (Mass Assignment).
     */
    protected $fillable = [
        'role',
        'nim_hash',
        'password',
        'unlock_pin_hash',
    ];

    /**
     * Kolom rahasia yang otomatis disembunyikan dari output JSON/Array.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'unlock_pin_hash',
    ];
}