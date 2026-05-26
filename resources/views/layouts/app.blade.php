<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPATUO - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AlpineJS for interactive UI components -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="bg-slate-950 text-slate-200 antialiased font-sans selection:bg-brand-500 selection:text-white flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col transition-all duration-300 z-20 flex-shrink-0">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('img/logo-sipatuo.png') }}" alt="SIPATUO Logo" class="h-10 w-auto object-contain drop-shadow-[0_0_15px_rgba(14,165,233,0.3)]">
                
                <div class="flex flex-col ml-1">
                    <span class="text-white font-bold tracking-tight text-xl leading-tight">SIPATUO</span>
                    <span class="text-brand-400 text-[9px] uppercase font-bold tracking-widest">ITH Security</span>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-2">
            @can('access-student')
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 px-3">Menu Mahasiswa</div>
                <a href="{{ route('complaints.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('complaints.index') ? 'bg-brand-500/10 text-brand-400 border border-brand-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white transition-colors' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span class="font-medium text-sm">Riwayat Pengaduan</span>
                </a>
                <a href="{{ route('complaints.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('complaints.create') ? 'bg-brand-500/10 text-brand-400 border border-brand-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white transition-colors' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span class="font-medium text-sm">Buat Pengaduan</span>
                </a>
            @endcan

            @can('access-satgas')
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 px-3 mt-4">Menu Satgas</div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard', 'admin.show') ? 'bg-purple-500/10 text-purple-400 border border-purple-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white transition-colors' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span class="font-medium text-sm">Verifikasi & Dekripsi</span>
                </a>
            @endcan

            @can('access-admin')
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 px-3 mt-4">Menu Admin</div>
                <a href="{{ route('admin.management') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.management') ? 'bg-rose-500/10 text-rose-400 border border-rose-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white transition-colors' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="font-medium text-sm">Kelola Pengguna</span>
                </a>
            @endcan
        </div>

        <!-- Role Badge & Logout -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center justify-between px-3 py-2 bg-slate-950 rounded-lg border border-slate-800">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs text-slate-400 font-medium">Logged in as</span>
                        <span class="text-xs font-bold text-white uppercase">{{ auth()->user()->role }}</span>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-950">
        
        <!-- TOP NAVBAR -->
        <header class="h-20 flex items-center justify-between px-8 border-b border-slate-800 bg-slate-900/50 backdrop-blur-md z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-bold text-white">@yield('title', 'Dashboard')</h2>
                <p class="text-sm text-slate-400 mt-0.5">@yield('subtitle', 'SIPATUO Encrypted System')</p>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- System Status Indicator -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-medium text-emerald-400 tracking-wide">Secure Connection</span>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <div class="flex-1 overflow-y-auto p-8 relative">
            <!-- Background Orbs for Premium Feel -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-brand-500/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-7xl mx-auto">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" class="mb-6 flex items-center justify-between p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="font-medium text-sm">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-400 hover:text-emerald-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-bold text-sm">Terjadi Kesalahan:</span>
                            </div>
                            <button @click="show = false" class="text-rose-400 hover:text-rose-300"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                        </div>
                        <ul class="list-disc list-inside text-sm pl-7 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
