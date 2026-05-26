@extends('layouts.app')

@section('title', 'Dekripsi Laporan')
@section('subtitle', 'Data dipulihkan secara lokal menggunakan RSA Private Key')

@section('content')

<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('admin.dashboard') }}" class="p-2 bg-slate-900 border border-slate-800 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    </a>
    <div class="px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg text-xs font-bold font-mono tracking-wider flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        DATA DECRYPTED IN MEMORY
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- LEFT SIDEBAR -->
    <div class="space-y-6">
        
        <!-- Status Management -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-slate-800">
                <div class="w-10 h-10 rounded-lg bg-brand-500/10 flex items-center justify-center text-brand-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Manajemen Kasus</h3>
                    <p class="text-xs text-slate-500">Tindak lanjut laporan</p>
                </div>
            </div>
            
            <form action="{{ route('admin.update_status', $complaint->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-2">Update Status Laporan</label>
                    <select name="status" class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-200 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition cursor-pointer">
                        <option value="Pending" {{ $complaint->status === 'Pending' ? 'selected' : '' }}>Pending - Menunggu Review</option>
                        <option value="Diproses" {{ $complaint->status === 'Diproses' ? 'selected' : '' }}>Diproses - Sedang Diselidiki</option>
                        <option value="Selesai" {{ $complaint->status === 'Selesai' ? 'selected' : '' }}>Selesai - Kasus Ditutup</option>
                        <option value="Ditolak" {{ $complaint->status === 'Ditolak' ? 'selected' : '' }}>Ditolak - Tidak Valid</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-brand-600 to-cyan-600 hover:from-brand-500 hover:to-cyan-500 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>

        <!-- 2FA Identity Unlock -->
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl shadow-xl">
            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-slate-800">
                <div class="w-10 h-10 rounded-lg bg-rose-500/10 flex items-center justify-center text-rose-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">Otorisasi Identitas</h3>
                    <p class="text-xs text-slate-500">Buka Blind Index NIM</p>
                </div>
            </div>

            @if(!$nimUnlocked)
                @if(session('pin_error'))
                    <div class="mb-3 p-2 bg-rose-500/10 border border-rose-500/20 rounded-lg text-rose-400 text-xs text-center font-medium">
                        {{ session('pin_error') }}
                    </div>
                @endif
                <form action="{{ url()->current() }}" method="GET" class="space-y-3">
                    <div class="relative">
                        <input type="password" name="pin" placeholder="PIN 2FA Admin" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-center tracking-[0.5em] text-slate-200 focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition font-mono">
                    </div>
                    <button type="submit" class="w-full bg-rose-500/10 hover:bg-rose-500 border border-rose-500/30 hover:border-rose-500 text-rose-400 hover:text-white font-bold py-3 rounded-xl text-xs transition-all shadow-lg hover:shadow-rose-500/25">
                        Dekripsi NIM Asli Pelapor
                    </button>
                    <p class="text-[10px] text-slate-500 text-center mt-2 leading-tight">Membuka identitas pelapor akan dicatat dalam Audit Log untuk akuntabilitas.</p>
                </form>
            @else
                <div class="bg-emerald-500/10 border border-emerald-500/30 p-4 rounded-xl text-center">
                    <svg class="w-8 h-8 text-emerald-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h4 class="text-sm font-bold text-emerald-400 mb-1">Identitas Terbuka</h4>
                    <p class="text-xs text-emerald-500/80 font-mono">Otorisasi PIN Valid.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- MAIN CONTENT DECRYPTED -->
    <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden relative">
            <!-- Background watermark -->
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
                <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L3 7l1 14.5C4 23 12 24 12 24s8-1 8-2.5L21 7 12 2zm0 2.2l7 3.8-.8 12c-.5 1-4.5 1.8-6.2 2-1.7-.2-5.7-1-6.2-2l-.8-12 7-3.8z"/></svg>
            </div>

            <div class="p-8 relative z-10 space-y-8">
                
                <!-- Profil Pengadu -->
                <div>
                    <h3 class="text-xs font-bold text-purple-400 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Data Pelapor (Plaintext)
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Nama Lengkap</p>
                            <p class="text-base font-bold text-white">{{ $identity['name'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Nomor WhatsApp/Kontak</p>
                            <p class="text-base font-mono text-slate-300">{{ $identity['contact'] }}</p>
                        </div>
                        <div class="sm:col-span-2 mt-2">
                            <p class="text-xs text-slate-500 mb-1">Nomor Induk Mahasiswa (NIM)</p>
                            @if($nimUnlocked)
                                <div class="inline-block bg-slate-950 border border-slate-700 px-3 py-1.5 rounded-lg text-brand-400 font-mono font-bold tracking-widest">
                                    {{ $identity['nim'] ?? 'NIM DECRYPTED' }} <!-- Asumsikan ada nim di identity, if not it will fallback -->
                                </div>
                            @else
                                <div class="inline-flex items-center gap-2 bg-slate-950 border border-slate-800 px-3 py-1.5 rounded-lg text-slate-500 font-mono italic text-sm">
                                    <svg class="w-4 h-4 text-rose-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    [TERKUNCI] Butuh 2FA
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Isi Laporan -->
                <div>
                    <h3 class="text-xs font-bold text-purple-400 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Isi Kronologi Aduan
                    </h3>
                    <div class="bg-slate-950 p-6 rounded-xl border border-slate-800 shadow-inner">
                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-wrap select-text font-serif">
                            {{ $decryptedContent }}
                        </p>
                    </div>
                </div>

                <!-- Lampiran File -->
                <div>
                    <h3 class="text-xs font-bold text-purple-400 uppercase tracking-widest mb-4 flex items-center gap-2 border-b border-slate-800 pb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        Lampiran File Terenkripsi
                    </h3>
                    
                    @if(count($decryptedFiles) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($decryptedFiles as $file)
                                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800 flex flex-col justify-between group hover:border-purple-500/50 transition-colors">
                                    <div class="flex items-start gap-3 mb-4">
                                        <div class="w-10 h-10 rounded bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-500 shrink-0">
                                            <span class="text-[10px] font-bold uppercase">{{ explode('/', $file['mime_type'])[1] ?? 'FILE' }}</span>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="text-sm font-medium text-slate-300 truncate" title="{{ $file['filename'] }}">{{ $file['filename'] }}</p>
                                            <p class="text-[10px] text-slate-500 mt-0.5 font-mono">ENCRYPTED BLOB</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin.download_file', $file['id']) }}" class="w-full flex items-center justify-center gap-2 py-2 bg-purple-500/10 hover:bg-purple-500 border border-purple-500/20 text-purple-400 hover:text-white rounded-lg text-xs font-bold transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Dekripsi & Unduh
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-6 bg-slate-950 border border-slate-800 border-dashed rounded-xl flex items-center justify-center">
                            <p class="text-sm text-slate-500 italic flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Laporan ini tidak memiliki lampiran berkas biner.
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@endsection