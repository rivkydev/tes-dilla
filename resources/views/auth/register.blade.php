<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SIPATUO ITH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            500: '#0ea5e9',
                            600: '#0284c7',
                        }
                    },
                    keyframes: {
                        'slide-right': {
                            '0%': { opacity: 0, transform: 'translateX(-40px)' },
                            '100%': { opacity: 1, transform: 'translateX(0)' }
                        }
                    },
                    animation: {
                        'slide-right': 'slide-right 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-200 antialiased font-sans min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Decor -->
    <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-cyan-600/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="w-full max-w-5xl bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-800 flex flex-col md:flex-row-reverse overflow-hidden relative z-10">
        
        <!-- Left Side (Visually Right): Branding & Info -->
        <div class="w-full md:w-5/12 bg-slate-900/50 p-10 flex flex-col items-center justify-center border-l border-slate-800/50 relative overflow-hidden">
            <!-- Glow effect behind logo -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-600/30 blur-[80px] rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="{{ asset('img/logo-sipatuo.png') }}" alt="SIPATUO Logo" class="h-40 sm:h-48 w-auto object-contain mb-6 drop-shadow-[0_0_25px_rgba(59,130,246,0.5)]">
                
                <p class="text-slate-400 font-medium text-sm tracking-wide mb-8 mt-2">Aman. Terenkripsi. Terotorisasi.</p>

                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-blue-400 hover:text-blue-300 transition-colors group mt-4">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                    Kembali ke Login
                </a>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full md:w-7/12 p-10 lg:p-16 flex flex-col justify-center animate-slide-right">
            <div class="max-w-md mx-auto w-full">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-white">Registrasi Mahasiswa</h1>
                    <p class="text-slate-400 text-sm mt-2">Buat akun untuk melaporkan isu secara aman</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-start gap-3 text-rose-400 text-sm font-medium">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition" placeholder="Contoh: 2022010023">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                            <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-slate-100 placeholder-slate-600 focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-400 hover:to-green-400 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-blue-500/25 hover:shadow-green-500/40 hover:-translate-y-0.5">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-8 border-t border-slate-800 text-center flex flex-col gap-4">
                    <p class="text-sm text-slate-400">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-brand-400 hover:text-brand-300 font-semibold transition-colors">Masuk di sini</a>
                    </p>
                    <a href="{{ url('/') }}" class="text-sm font-medium text-slate-500 hover:text-white transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
