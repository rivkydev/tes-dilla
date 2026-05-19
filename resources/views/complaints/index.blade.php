<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengaduan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-6">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-8 bg-slate-800 p-6 rounded-2xl border border-slate-700">
            <div>
                <h1 class="text-xl font-bold text-slate-100">Panel Pengaduan Mahasiswa</h1>
                <p class="text-sm text-slate-400 mt-1">Status Enkripsi Data Anda: <span class="text-emerald-400 font-semibold">AKTIF (E2EE)</span></p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('complaints.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-slate-950 px-4 py-2 rounded-lg text-sm font-semibold transition">Buat Aduan Baru</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-rose-600/20 text-rose-400 border border-rose-600 hover:bg-rose-600 hover:text-white px-4 py-2 rounded-lg text-sm transition">Keluar</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 p-4 rounded-xl text-sm mb-6">
                <p class="font-semibold">{{ session('success') }}</p>
                @if(session('token'))
                    <div class="mt-2 p-2 bg-slate-950 rounded border border-slate-700 select-all font-mono text-center text-cyan-400 text-base">
                        Kode Resi Pelacakan Anonim Anda: {{ session('token') }}
                    </div>
                    <p class="text-xs text-slate-400 mt-1">*Simpan kode UUID di atas untuk mengecek status aduan tanpa perlu login.</p>
                @endif
            </div>
        @endif

        <h2 class="text-lg font-semibold mb-4 text-slate-300">Riwayat Pengaduan Anda</h2>
        <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden shadow-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950 text-slate-400 text-xs font-semibold uppercase tracking-wider border-b border-slate-700">
                        <th class="p-4">Tanggal Masuk</th>
                        <th class="p-4">Kode Resi (UUID)</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 text-sm text-slate-300">
                    @forelse($complaints as $complaint)
                        <tr class="hover:bg-slate-750 transition">
                            <td class="p-4">{{ $complaint->created_at->format('d M Y H:i') }} WIB</td>
                            <td class="p-4 font-mono text-xs text-slate-400 select-all">{{ $complaint->tracking_token }}</td>
                            <td class="p-4"><span class="bg-slate-900 border border-slate-700 px-2.5 py-1 rounded-md text-xs text-slate-300">{{ $complaint->category }}</span></td>
                            <td class="p-4">
                                @if($complaint->status === 'Pending')
                                    <span class="bg-amber-500/10 text-amber-400 border border-amber-500/30 px-2.5 py-0.5 rounded-full text-xs font-medium">Pending</span>
                                @elseif($complaint->status === 'Diproses')
                                    <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/30 px-2.5 py-0.5 rounded-full text-xs font-medium">Diproses</span>
                                @elseif($complaint->status === 'Selesai')
                                    <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 px-2.5 py-0.5 rounded-full text-xs font-medium">Selesai</span>
                                @else
                                    <span class="bg-rose-500/10 text-rose-400 border border-rose-500/30 px-2.5 py-0.5 rounded-full text-xs font-medium">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-slate-500">Belum ada riwayat pengaduan terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>