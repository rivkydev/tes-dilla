<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Validasi NIM: Wajib diisi, hanya angka, panjang karakter minimal 8 dan maksimal 12 (bisa disesuaikan)
            'nim'      => ['required', 'string', 'regex:/^[0-9]+$/', 'min:8', 'max:12'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.regex'    => 'Format NIM tidak valid. Harus berupa angka.',
            'nim.min'      => 'NIM minimal berukuran 8 digit.',
            'nim.max'      => 'NIM maksimal berukuran 12 digit.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}