<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan Terenkripsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-200">Lembar Dekripsi Pengaduan</h1>
                <p class="text-sm text-slate-400">Data di bawah dipulihkan menggunakan skema gabungan kunci asimetris secara lokal di memori server</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm bg-slate-800 border border-slate-700 px-4 py-2 rounded-lg hover:bg-slate-700 transition">Kembali</a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 p-3 rounded-lg text-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-6">
                <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 shadow-xl">
                    <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">Manajemen Kasus</h3>
                    <form action="{{ route('admin.update_status', $complaint->id) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200 focus:outline-none">
                            <option value="Pending" {{ $complaint->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diproses" {{ $complaint->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $complaint->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Ditolak" {{ $complaint->status === 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-semibold py-2 rounded-lg text-xs transition">
                            Perbarui Status
                        </button>
                    </form>
                </div>

                <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700 shadow-xl">
                    <h3 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">Otorisasi Identitas (2FA)</h3>
                    @if(!$nimUnlocked)
                        @if(session('pin_error'))
                            <p class="text-xs text-rose-400 mb-2">{{ session('pin_error') }}</p>
                        @endif
                        <form action="{{ url()->current() }}" method="GET" class="space-y-3">
                            <input type="password" name="pin" placeholder="Masukkan PIN 2FA Admin" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-xs text-center tracking-widest text-slate-200 focus:outline-none">
                            <button type="submit" class="w-full bg-slate-700 hover:bg-slate-600 text-slate-200 font-semibold py-2 rounded-lg text-xs transition">
                                Ungkap NIM Asli Pelapor
                            </button>
                        </form>
                    @else
                        <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-3 rounded-lg text-xs text-center font-medium">
                            ✓ Kunci Kriptografi NIM Mahasiswa Berhasil Dibuka
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">
                <div class="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl space-y-6">
                    <div>
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Profil Pengadu (Terpugar)</h3>
                        <p class="text-base font-bold text-slate-200">{{ $identity['name'] }}</p>
                        <p class="text-sm text-slate-400 mt-1">Kontak HP: <span class="text-slate-200 font-mono">{{ $identity['contact'] }}</span></p>
                        <p class="text-sm text-slate-400 mt-1">
                            NIM Mahasiswa: 
                            @if($nimUnlocked)
                                <span class="text-cyan-400 font-mono font-bold bg-slate-950 px-2 py-0.5 rounded border border-slate-700">Terbuka (PIN Valid)</span>
                            @else
                                <span class="text-slate-500 font-mono italic">🔒 [Disensor - Masukkan PIN 2FA untuk melihat]</span>
                            @endif
                        </p>
                    </div>

                    <hr class="border-slate-700">

                    <div>
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Isi Kronologi Kejadian / Laporan</h3>
                        <div class="bg-slate-950 p-4 rounded-xl border border-slate-700 text-slate-300 text-sm leading-relaxed whitespace-pre-wrap select-text">
                            {{ $decryptedContent }}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Berkas Lampiran Pendukung Terenkripsi</h3>
                        @if(count($decryptedFiles) > 0)
                            <div class="space-y-2">
                                @foreach($decryptedFiles as $file)
                                    <div class="flex justify-between items-center bg-slate-950 p-3 rounded-xl border border-slate-700">
                                        <div class="flex items-center gap-2.5 truncate">
                                            <span class="text-xs font-mono text-slate-500">[{{ strtoupper(explode('/', $file['mime_type'])[1] ?? 'FILE') }}]</span>
                                            <p class="text-xs text-slate-300 truncate font-mono">{{ $file['filename'] }}</p>
                                        </div>
                                        <a href="{{ route('admin.download_file', $file['id']) }}" class="text-xs bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 hover:bg-cyan-500 hover:text-slate-950 px-3 py-1.5 rounded-lg font-semibold transition shrink-0">
                                            Unduh & Dekripsi File
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-500 italic">Laporan ini tidak melampirkan berkas bukti biner.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>