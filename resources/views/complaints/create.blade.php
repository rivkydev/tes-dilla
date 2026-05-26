@extends('layouts.app')

@section('title', 'Kirim Pengaduan Baru')
@section('subtitle', 'Laporan Anda akan dienkripsi secara End-to-End')

@section('content')

<div class="max-w-4xl">
    
    <!-- Info Security Box -->
    <div class="mb-8 p-5 bg-purple-500/10 border border-purple-500/20 rounded-xl flex items-start gap-4">
        <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 flex-shrink-0 mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <div>
            <h4 class="text-sm font-bold text-white mb-1">Proteksi Kriptografi Aktif</h4>
            <p class="text-xs text-slate-400 leading-relaxed">
                Seluruh bodi pesan, identitas, dan lampiran file yang Anda unggah akan dienkripsi secara lokal di sisi server menggunakan <strong class="text-purple-400">AES-256-GCM</strong>. Kunci AES tersebut kemudian dibungkus dengan <strong class="text-purple-400">RSA-2048 Private Key</strong> milik Satgas. Pihak kampus dan Admin IT tidak akan bisa membacanya.
            </p>
        </div>
    </div>

    <!-- Form Panel -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-slate-800 bg-slate-900/50">
            <h3 class="text-lg font-semibold text-white">Formulir Laporan</h3>
        </div>
        
        <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap Anda</label>
                    <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition" placeholder="Masukkan nama (akan dienkripsi)">
                </div>
                <!-- Kontak -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Kontak / No. WhatsApp</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-slate-500 text-sm font-medium">+62</span>
                        </div>
                        <input type="text" name="contact" required class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-12 pr-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition" placeholder="81234567890">
                    </div>
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Kategori Masalah</label>
                <div class="relative">
                    <select name="category" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 appearance-none focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition cursor-pointer">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        <option value="Akademik">Fasilitas & Akademik</option>
                        <option value="Pungli">Laporan Pungutan Liar (Pungli)</option>
                        <option value="Pelecehan">Tindakan Pelecehan / Perundungan</option>
                        <option value="Infrastruktur">Sistem IT & Infrastruktur Kampus</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Isi Laporan -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Isi Laporan / Kronologi Kejadian</label>
                <textarea name="content" rows="6" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition resize-none" placeholder="Ceritakan detail masalah atau kronologi yang terjadi..."></textarea>
                <p class="text-xs text-slate-500 mt-2 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    Teks di atas akan diubah menjadi Ciphertext sebelum disimpan ke Database.
                </p>
            </div>

            <!-- Lampiran -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">File Lampiran Bukti (Opsional)</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-700 border-dashed rounded-xl cursor-pointer bg-slate-950 hover:bg-slate-900 transition-colors hover:border-brand-500 group">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 text-slate-500 mb-3 group-hover:text-brand-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <p class="mb-1 text-sm text-slate-400"><span class="font-semibold text-brand-400">Klik untuk upload</span> atau seret file ke sini</p>
                            <p class="text-xs text-slate-500">JPG, PNG, PDF, ZIP (Maks 5 File, @10MB)</p>
                        </div>
                        <input type="file" name="files[]" multiple class="hidden" accept=".jpg,.jpeg,.png,.pdf,.txt,.zip">
                    </label>
                </div>
                <!-- Mini info text -->
                <p class="text-xs text-slate-500 mt-2 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    File binari akan dienkripsi dan di-hash (SHA-256) untuk integritas.
                </p>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-800">
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-brand-600 to-cyan-600 hover:from-brand-500 hover:to-cyan-500 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Kunci & Kirim Laporan Secara Aman
                </button>
            </div>

        </form>
    </div>
</div>

@endsection