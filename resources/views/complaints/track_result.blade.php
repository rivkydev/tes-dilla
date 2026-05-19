<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengaduan Terlacak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-700 space-y-6">
        <div class="text-center">
            <h1 class="text-xl font-bold text-slate-200">Informasi Progres Kasus</h1>
            <p class="text-xs font-mono text-slate-400 mt-2 select-all">{{ $complaint->tracking_token }}</p>
        </div>

        <div class="bg-slate-950 p-5 rounded-xl border border-slate-700 space-y-4 text-sm">
            <div class="flex justify-between border-b border-slate-800 pb-2.5">
                <span class="text-slate-500">Kategori Aduan</span>
                <span class="font-medium text-slate-300">{{ $complaint->category }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2.5 items-center">
                <span class="text-slate-500">Status Tindak Lanjut</span>
                @if($complaint->status === 'Pending')
                    <span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Pending</span>
                @elseif($complaint->status === 'Diproses')
                    <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Diproses</span>
                @elseif($complaint->status === 'Selesai')
                    <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Selesai</span>
                @else
                    <span class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Ditolak</span>
                @endif
            </div>
            <div class="flex justify-between pt-1">
                <span class="text-slate-500">Tanggal Pengiriman</span>
                <span class="text-slate-400 font-mono text-xs">{{ $complaint->created_at->format('d M Y H:i') }} WIB</span>
            </div>
        </div>

        <p class="text-[11px] text-slate-500 text-center leading-relaxed">
            *Isi teks laporan dan file dokumen rahasia Anda disembunyikan dari halaman ini demi perlindungan anonimitas pelapor. Hanya Admin berwenang yang dapat melakukan dekripsi.
        </p>

        <a href="{{ route('complaints.track_form') }}" class="block w-full text-center bg-slate-700 hover:bg-slate-600 text-slate-200 py-2 rounded-lg text-xs font-semibold transition">
            Kembali Cari Token Lain
        </a>
    </div>
</body>
</html>