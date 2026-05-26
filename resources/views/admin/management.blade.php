<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise IT Infrastructure Panel - SafeReport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mono { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex">

    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shrink-0 hidden md:flex">
        <div>
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <span class="text-lg font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 flex items-center gap-2">
                    🛡️ SafeReport <span class="text-[10px] bg-slate-800 text-cyan-400 border border-slate-700 px-1.5 py-0.5 rounded font-mono font-normal">v1.0</span>
                </span>
            </div>
            <nav class="p-4 space-y-1.5">
                <div class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider px-3 mb-2 font-mono">Core Infrastructure</div>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500/10 to-transparent border border-cyan-500/20 text-cyan-400 text-sm font-semibold transition">
                    ⚙️ Management Akun
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 text-sm font-medium transition cursor-not-allowed" title="Modul Terkunci untuk Admin IT">
                    🔒 Modul Dekripsi <span class="text-[9px] bg-rose-500/10 text-rose-400 border border-rose-500/20 px-1 rounded font-mono">Satgas Only</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-slate-200 text-sm font-medium transition cursor-not-allowed">
                    📊 Log Audit Server
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center justify-between">
                <div class="truncate mr-2">
                    <p class="text-xs font-bold text-slate-300 truncate">SYS_ADMIN_CAMPUS</p>
                    <p class="text-[10px] text-slate-500 font-mono">IP: 127.0.0.1</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button class="bg-slate-800 border border-slate-700 hover:bg-rose-600/20 hover:text-rose-400 p-2 rounded-xl transition" title="Keluar">
                        🚪
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 min-w-0 flex flex-col">
        
        <header class="h-20 border-b border-slate-800 flex items-center justify-between px-6 sm:px-8 bg-slate-900/30 backdrop-blur">
            <div>
                <h1 class="text-lg font-bold text-slate-100">Portal Pengelola Infrastruktur IT</h1>
                <p class="text-xs text-slate-400 mt-0.5">Otorisasi Sektoral: <span class="text-rose-400 font-bold font-mono">ROLE_ADMIN_INFRASTRUCTURE</span></p>
            </div>
            <div class="hidden sm:flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-mono text-emerald-400 font-medium">Zero-Knowledge Storage Active</span>
            </div>
        </header>

        <div class="p-6 sm:p-8 space-y-6 flex-1 overflow-y-auto max-w-6xl w-full mx-auto">
            
            @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 p-4 rounded-xl text-sm flex items-center gap-3 shadow-lg">
                    <span>✅</span> <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-4 rounded-xl text-sm flex items-center gap-3 shadow-lg">
                    <span>⚠️</span> <p class="font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <div class="bg-gradient-to-r from-amber-500/10 via-amber-600/5 to-transparent border border-amber-500/20 p-5 rounded-2xl shadow-xl relative overflow-hidden">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-5xl opacity-10 select-none pointer-events-none">🔒</div>
                <div class="max-w-3xl">
                    <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider font-mono mb-1.5">Arsitektur Kriptografi: Cryptographic Separation of Duties</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Sistem ini mengisolasi wewenang secara mutlak. Akun Admin IT bertindak sebagai operator infrastruktur tanpa kepemilikan Kunci Privat RSA server. Hak akses dekripsi dokumen secara sistemik dan kriptografis hanya didelegasikan ke entitas <strong>Satgas Kampus</strong>. Bypass rute paksa akan memicu proteksi <span class="text-rose-400 font-mono font-bold bg-slate-950 px-1 py-0.5 rounded border border-slate-800">403 Forbidden</span>.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl flex items-center justify-between shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Total Personel Satgas</p>
                        <p class="text-2xl font-bold text-slate-100 mt-1 font-mono">{{ $users->where('role', 'satgas')->count() }} <span class="text-xs font-normal text-slate-400">Akun</span></p>
                    </div>
                    <div class="text-2xl p-3 bg-cyan-500/5 text-cyan-400 rounded-xl border border-cyan-500/10">👥</div>
                </div>
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl flex items-center justify-between shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Mahasiswa Terdaftar</p>
                        <p class="text-2xl font-bold text-slate-100 mt-1 font-mono">{{ $users->where('role', 'student')->count() }} <span class="text-xs font-normal text-slate-400">Blind Index</span></p>
                    </div>
                    <div class="text-2xl p-3 bg-amber-500/5 text-amber-400 rounded-xl border border-amber-500/10">🆔</div>
                </div>
                <div class="bg-slate-900 border border-slate-800 p-5 rounded-2xl flex items-center justify-between shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono">Status Kunci RSA</p>
                        <p class="text-sm font-bold text-emerald-400 mt-2 font-mono bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded inline-block">LOADED (2048-BIT)</p>
                    </div>
                    <div class="text-2xl p-3 bg-emerald-500/5 text-emerald-400 rounded-xl border border-emerald-500/10">⚙️</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">
                
                <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden lg:col-span-2">
                    <div class="p-5 border-b border-slate-800 bg-slate-900/50">
                        <h3 class="text-sm font-bold text-slate-200">Registrasi Personel Satgas</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pembuatan akun investigator dengan enkripsi searah database</p>
                    </div>
                    <form action="{{ route('admin.create_satgas') }}" method="POST" class="p-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1 font-mono font-medium tracking-wide">ID/USERNAME RESMI SATGAS</label>
                            <input type="text" name="username" required placeholder="Contoh: SATGAS_ID_01" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-100 font-mono focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/20 transition">
                        </div>
                        <div>
                            <label class="block text-[11px] text-slate-400 mb-1 font-mono font-medium tracking-wide">PASSWORD OTENTIKASI</label>
                            <input type="password" name="password" required placeholder="••••••••••••" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/20 transition">
                        </div>
                        <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 text-sm py-3 rounded-xl font-bold transition shadow-lg shadow-cyan-500/20 flex items-center justify-center gap-2">
                            <span>⚡</span> Daftarkan Akun Satgas
                        </button>
                    </form>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden lg:col-span-3 flex flex-col">
                    <div class="p-5 border-b border-slate-800 bg-slate-900/50">
                        <h3 class="text-sm font-bold text-slate-200">Daftar Akun Pengguna</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Visibilitas kredensial pelapor tersensor penuh menggunakan <span class="text-amber-400 font-mono">Blind Index Hash</span></p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <div class="max-h-[350px] overflow-y-auto">
                            <table class="w-full text-left border-collapse text-xs sm:text-sm">
                                <thead>
                                    <tr class="bg-slate-950 border-b border-slate-800 text-slate-400 font-mono text-[10px] uppercase tracking-wider sticky top-0 z-10">
                                        <th class="p-4">Struktur Identitas DB (SHA-256)</th>
                                        <th class="p-4">Hak Akses</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60 font-mono">
                                    @foreach($users as $u)
                                        <tr class="hover:bg-slate-850/40 transition">
                                            <td class="p-4 text-xs font-mono text-slate-300">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-slate-500 select-none">#️⃣</span>
                                                    <span class="truncate max-w-[180px] sm:max-w-[240px]" title="{{ $u->nim_hash }}">
                                                        {{ $u->nim_hash }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                @if($u->role === 'satgas')
                                                    <span class="bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 text-[10px] px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider">
                                                        {{ $u->role }}
                                                    </span>
                                                @else
                                                    <span class="bg-amber-500/10 text-amber-400 border border-amber-500/20 text-[10px] px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider">
                                                        {{ $u->role }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>