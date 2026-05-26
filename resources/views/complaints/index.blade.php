@extends('layouts.app')

@section('title', 'Riwayat Pengaduan Saya')
@section('subtitle', 'Lacak status dan progres laporan Anda')

@section('content')

<!-- Statistics Overview -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @php
        $total = $complaints->count();
        $pending = $complaints->where('status', 'Pending')->count();
        $selesai = $complaints->where('status', 'Selesai')->count();
    @endphp
    
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex items-center gap-4 hover:border-blue-500/50 transition-colors group">
        <div class="w-14 h-14 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 group-hover:bg-blue-500/20 transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <div>
            <p class="text-sm text-slate-400 font-medium">Total Aduan Anda</p>
            <h4 class="text-3xl font-black text-white">{{ $total }}</h4>
        </div>
    </div>
    
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex items-center gap-4 hover:border-amber-500/50 transition-colors group">
        <div class="w-14 h-14 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 group-hover:bg-amber-500/20 transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm text-slate-400 font-medium">Menunggu Diproses</p>
            <h4 class="text-3xl font-black text-white">{{ $pending }}</h4>
        </div>
    </div>
    
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex items-center gap-4 hover:border-emerald-500/50 transition-colors group">
        <div class="w-14 h-14 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500/20 transition-colors">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm text-slate-400 font-medium">Selesai/Ditutup</p>
            <h4 class="text-3xl font-black text-white">{{ $selesai }}</h4>
        </div>
    </div>
</div>

<!-- Header Action -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <h3 class="text-lg font-bold text-white">Daftar Pengaduan Anda</h3>
        <p class="text-sm text-slate-400">Status Enkripsi: <span class="text-emerald-400 font-semibold uppercase text-xs ml-1 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">End-to-End Encrypted</span></p>
    </div>
    <a href="{{ route('complaints.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-brand-600 to-cyan-600 hover:from-brand-500 hover:to-cyan-500 text-white text-sm font-bold rounded-xl shadow-lg shadow-brand-500/20 hover:shadow-brand-500/40 hover:-translate-y-0.5 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Buat Pengaduan Baru
    </a>
</div>

@if(session('token'))
<!-- Resi Tracking Alert -->
<div x-data="{ showToken: true }" x-show="showToken" class="mb-8 p-6 bg-gradient-to-r from-slate-900 to-slate-800 border border-brand-500/30 rounded-2xl relative overflow-hidden shadow-2xl">
    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="relative z-10">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-brand-500/20 flex items-center justify-center text-brand-400 flex-shrink-0 border border-brand-500/30">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <div class="flex-1">
                <h4 class="text-lg font-bold text-white mb-1">Pengaduan Berhasil Terenkripsi</h4>
                <p class="text-sm text-slate-400 mb-4">Laporan Anda telah dikunci dengan kunci AES unik. Gunakan Resi (UUID) di bawah ini untuk melacak status tanpa perlu login.</p>
                <div class="flex items-center gap-2">
                    <div class="bg-slate-950 border border-slate-700 px-4 py-3 rounded-lg font-mono text-cyan-400 text-sm tracking-wider select-all flex-1">
                        {{ session('token') }}
                    </div>
                    <button @click="navigator.clipboard.writeText('{{ session('token') }}'); alert('Resi disalin!')" class="p-3 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-lg text-slate-300 transition-colors" title="Salin Resi">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <button @click="showToken = false" class="absolute top-4 right-4 text-slate-500 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
</div>
@endif

<!-- Cards Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    @forelse($complaints as $complaint)
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 hover:border-slate-700 transition-colors relative overflow-hidden group">
            
            <!-- Status Badge (Absolute Top Right) -->
            <div class="absolute top-6 right-6">
                @if($complaint->status === 'Pending')
                    <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> Pending
                    </span>
                @elseif($complaint->status === 'Diproses')
                    <span class="inline-flex items-center gap-1.5 bg-brand-500/10 text-brand-400 border border-brand-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-400 animate-pulse"></span> Diproses
                    </span>
                @elseif($complaint->status === 'Selesai')
                    <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Selesai
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 bg-rose-500/10 text-rose-400 border border-rose-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Ditolak
                    </span>
                @endif
            </div>

            <!-- Content Details -->
            <div class="pr-32">
                <span class="inline-block px-2.5 py-1 bg-slate-800 text-slate-300 text-xs font-semibold rounded mb-4">
                    {{ $complaint->category }}
                </span>
                
                <h4 class="text-sm text-slate-400 mb-1">Kode Resi / Token (UUID):</h4>
                <div class="font-mono text-sm text-brand-400 bg-slate-950 px-3 py-2 rounded border border-slate-800 mb-4 inline-block select-all">
                    {{ $complaint->tracking_token }}
                </div>
            </div>

            <!-- Footer Details -->
            <div class="mt-4 pt-4 border-t border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs text-slate-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Dikirim pada: {{ $complaint->created_at->format('d M Y, H:i') }}
                </div>
                
                <!-- Security Indicator Mini -->
                <div class="flex items-center gap-1 text-slate-600 group-hover:text-slate-500 transition-colors" title="Data dienkripsi AES-256">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    <span class="text-[10px] font-mono uppercase tracking-widest">AES-GCM</span>
                </div>
            </div>

        </div>
    @empty
        <div class="col-span-1 lg:col-span-2 flex flex-col items-center justify-center p-12 bg-slate-900 border border-slate-800 rounded-2xl border-dashed">
            <div class="w-16 h-16 bg-slate-800 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <h4 class="text-lg font-semibold text-white mb-2">Belum Ada Pengaduan</h4>
            <p class="text-sm text-slate-400 text-center max-w-md">Anda belum pernah membuat laporan. Identitas dan laporan Anda dijamin aman dengan kriptografi hybrid.</p>
        </div>
    @endforelse
</div>

@endsection