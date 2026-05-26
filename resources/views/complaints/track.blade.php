<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pengaduan - SIPATUO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { brand: { 500: '#0ea5e9', 600: '#0284c7' } }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-200 antialiased font-sans min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <div class="absolute top-1/4 left-1/4 w-[30%] h-[30%] bg-brand-600/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-md bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-800 p-8 relative z-10">
        
        <div class="flex justify-center mb-6">
            <div class="flex items-center gap-3">
                <img src="{{asset('img/Logo Ilmu Komputer ITH.png')}}" alt="Ilmu Komputer ITH" class="h-10 w-auto object-contain drop-shadow-md">
                <img src="{{asset('img/logo-sipatuo.png')}}" alt="SIPATUO" class="h-10 w-auto object-contain drop-shadow-[0_0_15px_rgba(14,165,233,0.4)]">
            </div>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white mb-2">Pelacakan Anonim</h1>
            <p class="text-slate-400 text-sm">Masukkan kode resi UUID untuk melihat progres laporan Anda secara instan</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 p-4 rounded-xl text-sm mb-6 flex items-center gap-3 font-medium">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('complaints.track_process') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-2 text-center">Resi Pelacakan (UUID)</label>
                <input type="text" name="token" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-4 text-center font-mono text-brand-400 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition text-sm shadow-inner">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-brand-600 to-cyan-600 hover:from-brand-500 hover:to-cyan-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:-translate-y-0.5">
                Cari Data Pengaduan
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-800 flex justify-center gap-6">
            <a href="{{ url('/') }}" class="text-sm font-medium text-slate-500 hover:text-white transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <span class="text-slate-700">|</span>
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-500 hover:text-white transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Login
            </a>
        </div>
    </div>
</body>
</html>
