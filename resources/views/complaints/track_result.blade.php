<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengaduan - SIPATUO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-950 text-slate-200 antialiased font-sans min-h-screen flex items-center justify-center p-4 relative">
    
    <div class="w-full max-w-md bg-slate-900 border border-slate-800 p-8 rounded-3xl shadow-2xl relative z-10">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-brand-500/10 text-brand-400 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-brand-500/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            </div>
            <h1 class="text-xl font-bold text-white">Status Laporan Ditemukan</h1>
            <p class="text-xs font-mono text-slate-500 mt-2 bg-slate-950 py-1.5 px-3 rounded-lg border border-slate-800 inline-block select-all">{{ $complaint->tracking_token }}</p>
        </div>

        <div class="bg-slate-950 p-6 rounded-2xl border border-slate-800 space-y-5">
            <div>
                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Kategori Masalah</p>
                <p class="text-sm font-semibold text-slate-300">{{ $complaint->category }}</p>
            </div>
            
            <div class="border-t border-slate-800 pt-5">
                <p class="text-xs text-slate-500 uppercase tracking-wider mb-2">Status Saat Ini</p>
                @if($complaint->status === 'Pending')
                    <span class="inline-flex items-center gap-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/20 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider w-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> PENDING (Menunggu Review)
                    </span>
                @elseif($complaint->status === 'Diproses')
                    <span class="inline-flex items-center gap-1.5 bg-brand-500/10 text-brand-400 border border-brand-500/20 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider w-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-400"></span> DIPROSES (Sedang Diselidiki)
                    </span>
                @elseif($complaint->status === 'Selesai')
                    <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider w-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> SELESAI (Kasus Ditutup)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider w-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> DITOLAK (Tidak Valid)
                    </span>
                @endif
            </div>

            <div class="border-t border-slate-800 pt-5">
                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Tanggal Pengajuan</p>
                <p class="text-sm font-mono text-slate-400">{{ $complaint->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-[10px] text-slate-500 leading-relaxed max-w-xs mx-auto">
                <svg class="w-3 h-3 inline-block mb-0.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Isi laporan dan lampiran Anda disembunyikan untuk melindungi anonimitas pelapor di ruang publik.
            </p>
        </div>

        <a href="{{ route('complaints.track_form') }}" class="mt-8 block w-full text-center bg-slate-800 hover:bg-slate-700 text-white font-medium py-3.5 rounded-xl text-sm transition-colors border border-slate-700">
            Lacak Resi Lainnya
        </a>
    </div>
</body>
</html>
