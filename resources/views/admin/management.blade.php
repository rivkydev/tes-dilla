@extends('layouts.app')

@section('title', 'Portal IT Infrastructure')
@section('subtitle', 'Otorisasi Role: SYS_ADMIN_CAMPUS')

@section('content')

<!-- Strict Separation of Duties Warning -->
<div class="mb-8 p-6 bg-rose-500/10 border border-rose-500/30 rounded-2xl relative overflow-hidden shadow-2xl">
    <div class="absolute right-0 top-1/2 -translate-y-1/2 text-[120px] opacity-5 select-none pointer-events-none">🔒</div>
    <div class="relative z-10 max-w-4xl">
        <h3 class="text-sm font-bold text-rose-400 uppercase tracking-wider font-mono mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            RESTRICTED ACCESS: CRYPTOGRAPHIC SEPARATION OF DUTIES
        </h3>
        <p class="text-sm text-slate-300 leading-relaxed font-mono">
            Anda login sebagai <strong class="text-white">Admin IT</strong>. Sistem ini mengisolasi wewenang secara mutlak. Anda bertindak sebagai operator infrastruktur tanpa memiliki <span class="text-rose-400 font-bold">Kunci Privat RSA server</span>. Hak akses untuk mendekripsi, membaca, atau mengubah status laporan hanya dimiliki oleh <strong class="text-purple-400">Satgas Kampus</strong>. Bypass rute paksa ke modul dekripsi akan memicu proteksi <span class="bg-slate-900 border border-rose-500/30 px-1.5 py-0.5 rounded text-rose-400">403 Forbidden</span>.
        </p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-xl group hover:border-cyan-500 transition-colors">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono mb-1">Total Personel Satgas</p>
            <p class="text-3xl font-bold text-white font-mono">{{ $users->where('role', 'satgas')->count() }} <span class="text-sm font-normal text-slate-400 font-sans">Akun</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500 group-hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
    </div>
    
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-xl group hover:border-amber-500 transition-colors">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono mb-1">Mahasiswa Terdaftar</p>
            <p class="text-3xl font-bold text-white font-mono">{{ $users->where('role', 'student')->count() }} <span class="text-sm font-normal text-slate-400 font-sans">Blind Index</span></p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 group-hover:bg-amber-500 group-hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
    </div>
    
    <div class="bg-slate-900 border border-slate-800 p-6 rounded-2xl flex items-center justify-between shadow-xl group hover:border-emerald-500 transition-colors">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider font-mono mb-1">Status Kunci RSA</p>
            <p class="text-xs font-bold text-emerald-400 font-mono mt-2 bg-emerald-500/10 border border-emerald-500/20 px-2 py-1 rounded inline-flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                LOADED (2048-BIT)
            </p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500 group-hover:text-slate-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    <!-- Form Registrasi Satgas -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden lg:col-span-2 flex flex-col">
        <div class="p-6 border-b border-slate-800 bg-slate-900/50">
            <h3 class="text-base font-bold text-white">Registrasi Personel Satgas</h3>
            <p class="text-xs text-slate-400 mt-1">Buat akun untuk investigator berwenang</p>
        </div>
        <form action="{{ route('admin.create_satgas') }}" method="POST" class="p-6 space-y-5 flex-1">
            @csrf
            <div>
                <label class="block text-xs text-slate-400 mb-2 font-mono font-medium tracking-wide">ID/USERNAME RESMI SATGAS</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </div>
                    <input type="text" name="username" required placeholder="Contoh: SATGAS_ID_01" class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-100 font-mono focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition">
                </div>
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-2 font-mono font-medium tracking-wide">PASSWORD OTENTIKASI</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••••••" class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-100 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition">
                </div>
            </div>
            <div class="pt-2">
                <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-slate-900 font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Daftarkan Akun Satgas
                </button>
            </div>
        </form>
    </div>

    <!-- Data Table User -->
    <div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden lg:col-span-3 flex flex-col h-[450px]">
        <div class="p-6 border-b border-slate-800 bg-slate-900/50 flex justify-between items-center shrink-0">
            <div>
                <h3 class="text-base font-bold text-white">Daftar Akun Pengguna</h3>
                <p class="text-xs text-slate-400 mt-1">Identitas disensor dengan <span class="text-amber-400 font-mono">SHA-256 Blind Index</span></p>
            </div>
        </div>
        
        <div class="overflow-y-auto flex-1 p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-slate-400 font-mono text-[10px] uppercase tracking-wider sticky top-0 bg-slate-900 z-10">
                        <th class="p-4 border-b border-slate-800">Struktur Identitas DB</th>
                        <th class="p-4 border-b border-slate-800 text-right">Role Akses</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-mono text-xs text-slate-300">
                    @foreach($users as $u)
                        <tr class="hover:bg-slate-800/50 transition-colors">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-500 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <span class="truncate max-w-[200px] sm:max-w-[300px]" title="{{ $u->nim_hash }}">
                                        {{ $u->nim_hash ?? 'NULL_IDENTIFIER' }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-4 text-right">
                                @if($u->role === 'satgas')
                                    <span class="inline-flex items-center gap-1.5 bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 px-2.5 py-1 rounded-md font-bold uppercase tracking-wider">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        {{ $u->role }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-slate-800 text-slate-400 border border-slate-700 px-2.5 py-1 rounded-md font-bold uppercase tracking-wider">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
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

<!-- System Server Monitoring (UI Only) -->
<div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden mt-8">
    <div class="p-6 border-b border-slate-800 bg-slate-900/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h3 class="text-lg font-semibold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Server Performance & Cryptography Logs
        </h3>
        <div class="flex items-center gap-4 text-xs font-mono">
            <div class="flex items-center gap-2 text-slate-400">
                <span>CPU: </span><span class="text-emerald-400 font-bold">12%</span>
            </div>
            <div class="flex items-center gap-2 text-slate-400">
                <span>RAM: </span><span class="text-amber-400 font-bold">2.4GB</span>
            </div>
            <div class="flex items-center gap-2 text-slate-400">
                <span>UPTIME: </span><span class="text-blue-400 font-bold">99.9%</span>
            </div>
        </div>
    </div>
    <div class="bg-slate-950 p-6 font-mono text-[11px] sm:text-xs text-slate-400 h-64 overflow-y-auto space-y-2 border-t border-slate-800/50 relative">
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:20px_20px] pointer-events-none opacity-20"></div>
        <div class="flex gap-4 relative z-10"><span class="text-slate-500">[{{ now()->subMinutes(12)->format('Y-m-d H:i:s') }}]</span><span class="text-blue-400">[INFO]</span><span> SYSTEM_BOOT: Server SIPATUO started successfully.</span></div>
        <div class="flex gap-4 relative z-10"><span class="text-slate-500">[{{ now()->subMinutes(11)->format('Y-m-d H:i:s') }}]</span><span class="text-blue-400">[INFO]</span><span> RSA_KEY_MANAGER: 2048-bit Private Key loaded into secure memory.</span></div>
        <div class="flex gap-4 relative z-10"><span class="text-slate-500">[{{ now()->subMinutes(5)->format('Y-m-d H:i:s') }}]</span><span class="text-amber-400">[WARN]</span><span> AUTH_MODULE: 3 failed login attempts detected from IP 192.168.1.45.</span></div>
        <div class="flex gap-4 relative z-10"><span class="text-slate-500">[{{ now()->subMinutes(2)->format('Y-m-d H:i:s') }}]</span><span class="text-emerald-400">[SUCCESS]</span><span> DB_SYNC: Synchronized 14 encrypted records with backup server.</span></div>
        <div class="flex gap-4 relative z-10"><span class="text-slate-500">[{{ now()->format('Y-m-d H:i:s') }}]</span><span class="text-cyan-400">[ENCRYPT]</span><span> AES-256-GCM Payload processed. Execution time: 42ms.</span></div>
        <div class="flex gap-4 relative z-10 opacity-70 animate-pulse mt-4"><span class="text-slate-500">[{{ now()->format('Y-m-d H:i:s') }}]</span><span class="text-slate-400">[SYSTEM]</span><span> Waiting for incoming secure connections...</span></div>
    </div>
</div>

@endsection