@extends('layouts.app')

@section('title', 'Panel Verifikasi Satgas')
@section('subtitle', 'Pusat Dekripsi Data & Tindak Lanjut Laporan')

@section('content')

<!-- Statistics Overview -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between group hover:border-brand-500 transition-colors">
        <div>
            <p class="text-sm font-medium text-slate-400">Total Aduan</p>
            <p class="text-2xl font-bold text-white mt-1">{{ $complaints->count() }}</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-brand-400 group-hover:bg-brand-500/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
    </div>
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between group hover:border-amber-500 transition-colors">
        <div>
            <p class="text-sm font-medium text-slate-400">Menunggu (Pending)</p>
            <p class="text-2xl font-bold text-white mt-1">{{ $complaints->where('status', 'Pending')->count() }}</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-amber-400 group-hover:bg-amber-500/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
    </div>
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between group hover:border-emerald-500 transition-colors">
        <div>
            <p class="text-sm font-medium text-slate-400">Selesai Ditangani</p>
            <p class="text-2xl font-bold text-white mt-1">{{ $complaints->where('status', 'Selesai')->count() }}</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 group-hover:text-emerald-400 group-hover:bg-emerald-500/10 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
    </div>
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between group hover:border-purple-500 transition-colors">
        <div>
            <p class="text-sm font-medium text-slate-400">RSA Key Status</p>
            <p class="text-sm font-bold text-emerald-400 mt-2">ACTIVE / LOADED</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center text-purple-400 border border-purple-500/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        </div>
    </div>
</div>

<!-- Data Table Section -->
<div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-6 border-b border-slate-800 bg-slate-900/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h3 class="text-lg font-semibold text-white">Antrean Pengaduan Global</h3>
        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-500 font-mono">ENCRYPTED DB</span>
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-slate-950/50 text-slate-400 text-xs font-semibold uppercase tracking-wider border-b border-slate-800">
                    <th class="p-4 pl-6">Tanggal Masuk</th>
                    <th class="p-4">Kode Resi (UUID)</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 pr-6 text-right">Aksi Dekripsi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800 text-sm text-slate-300">
                @forelse($complaints as $complaint)
                    <tr class="hover:bg-slate-800/50 transition-colors group">
                        <td class="p-4 pl-6">
                            <div class="flex flex-col">
                                <span class="font-medium text-slate-200">{{ $complaint->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-slate-500">{{ $complaint->created_at->format('H:i') }} WIB</span>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="font-mono text-xs text-brand-400 bg-slate-950 px-2 py-1 rounded inline-block border border-slate-800">
                                {{ substr($complaint->tracking_token, 0, 18) }}...
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="bg-slate-800 border border-slate-700 px-2.5 py-1 rounded-md text-xs font-medium text-slate-300">
                                {{ $complaint->category }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($complaint->status === 'Pending')
                                <span class="inline-flex items-center gap-1.5 text-amber-400 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Pending
                                </span>
                            @elseif($complaint->status === 'Diproses')
                                <span class="inline-flex items-center gap-1.5 text-brand-400 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span> Diproses
                                </span>
                            @elseif($complaint->status === 'Selesai')
                                <span class="inline-flex items-center gap-1.5 text-emerald-400 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-rose-400 text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="p-4 pr-6 text-right">
                            <a href="{{ route('admin.show', $complaint->id) }}" class="inline-flex items-center gap-2 bg-purple-500/10 hover:bg-purple-500 text-purple-400 hover:text-white border border-purple-500/20 hover:border-purple-500 px-4 py-2 rounded-lg font-semibold text-xs transition-all shadow-lg shadow-purple-500/0 hover:shadow-purple-500/25">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Buka & Dekripsi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-500">
                                <svg class="w-12 h-12 mb-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-base font-medium text-slate-400">Belum ada aduan masuk ke sistem.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection