<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'contact'    => ['required', 'string', 'max:50'],
            'category'   => ['required', 'string', 'max:100'],
            'content'    => ['required', 'string'],
            // Maksimal 5 file, masing-masing file maksimal 10MB (10240 KB) sesuai spek dokumen
            'files'      => ['nullable', 'array', 'max:5'],
            'files.*'    => ['file', 'mimes:jpg,png,pdf,txt,zip', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama pelapor wajib diisi.',
            'contact.required'  => 'Kontak/Nomor HP wajib diisi.',
            'category.required' => 'Kategori pengaduan wajib dipilih.',
            'content.required'  => 'Isi laporan pengaduan tidak boleh kosong.',
            'files.max'         => 'Anda maksimal hanya dapat mengunggah 5 file pendukung.',
            'files.*.mimes'     => 'Format file pendukung tidak valid. Hanya diizinkan: JPG, PNG, PDF, TXT, ZIP.',
            'files.*.max'       => 'Ukuran file pendukung terlalu besar. Maksimal berukuran 10MB.',
        ];
    }
}