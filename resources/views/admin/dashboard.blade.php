<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-8 bg-slate-800 p-6 rounded-2xl border border-slate-700">
            <div>
                <h1 class="text-xl font-bold text-cyan-400">Panel Utama Dekripsi Data Masuk</h1>
                <p class="text-sm text-slate-400 mt-1">Gunakan kunci privat server untuk memulihkan isi laporan mahasiswa</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-rose-600/20 text-rose-400 border border-rose-600 hover:bg-rose-600 hover:text-white px-4 py-2 rounded-lg text-sm font-semibold transition">Keluar</button>
            </form>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-4 rounded-xl text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <h2 class="text-lg font-semibold mb-4 text-slate-300">Daftar Antrean Pengaduan Global</h2>
        <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden shadow-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950 text-slate-400 text-xs font-semibold uppercase border-b border-slate-700">
                        <th class="p-4">Tanggal Aduan</th>
                        <th class="p-4">Kode Resi (UUID)</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700 text-sm text-slate-300">
                    @forelse($complaints as $complaint)
                        <tr class="hover:bg-slate-750 transition">
                            <td class="p-4">{{ $complaint->created_at->format('d M Y H:i') }}</td>
                            <td class="p-4 font-mono text-xs text-slate-400">{{ $complaint->tracking_token }}</td>
                            <td class="p-4"><span class="bg-slate-900 border border-slate-700 px-2.5 py-1 rounded-md text-xs">{{ $complaint->category }}</span></td>
                            <td class="p-4">
                                @if($complaint->status === 'Pending')
                                    <span class="text-amber-400 border border-amber-500/30 px-2 py-0.5 rounded-full text-xs font-medium">Pending</span>
                                @elseif($complaint->status === 'Diproses')
                                    <span class="text-cyan-400 border border-cyan-500/30 px-2 py-0.5 rounded-full text-xs font-medium">Diproses</span>
                                @elseif($complaint->status === 'Selesai')
                                    <span class="text-emerald-400 border border-emerald-500/30 px-2 py-0.5 rounded-full text-xs font-medium">Selesai</span>
                                @else
                                    <span class="text-rose-400 border border-rose-500/30 px-2 py-0.5 rounded-full text-xs font-medium">Ditolak</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('admin.show', $complaint->id) }}" class="inline-block bg-cyan-500 hover:bg-cyan-600 text-slate-950 px-3 py-1.5 rounded-md font-semibold text-xs transition">
                                    Buka & Dekripsi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500">Belum ada dokumen pengaduan yang masuk ke database.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>