<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPATUO ITH - Sistem Pengaduan Terenkripsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        @keyframes float { 
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .gradient-animate { 
            background-size: 200% 200%;
            animation: gradient-shift 15s ease infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-950 text-slate-100 antialiased">

    <!-- NAVIGATION -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-950/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3 sm:gap-5">
                    <img src="{{asset('img/Logo Ilmu Komputer ITH.png')}}" alt="Ilmu Komputer ITH" class="h-14 sm:h-16 w-auto object-contain drop-shadow-md">
                    
                    <img src="{{asset('img/logo-sipatuo.png')}}" alt="SIPATUO" class="h-14 sm:h-16 w-auto object-contain drop-shadow-[0_0_15px_rgba(14,165,233,0.5)]">
                    
                    <div class="flex flex-col ml-1 sm:ml-2">
                        <span class="text-xl sm:text-2xl font-black text-white tracking-tight leading-tight drop-shadow-lg">SIPATUO</span>
                        <span class="text-[9px] sm:text-[11px] font-bold text-cyan-400 uppercase tracking-widest">Ilmu Komputer ITH</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Fitur</a>
                    <a href="#security" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Keamanan</a>
                    <a href="{{ route('complaints.track_form') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Lacak Aduan</a>
                    <div class="h-5 w-px bg-slate-700"></div>
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-blue-400 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-sm font-bold rounded-xl hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 hover:scale-105">
                        Daftar Sekarang
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-lg bg-slate-800/50 hover:bg-slate-700/50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        <!-- Background Gradient Orbs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 -left-48 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl float-animation"></div>
            <div class="absolute bottom-1/4 -right-48 w-96 h-96 bg-cyan-600/20 rounded-full blur-3xl float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl float-animation" style="animation-delay: 4s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Logo Centered -->
                <div class="flex justify-center mb-6 relative">
                    <!-- Glow effect -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-blue-500/40 blur-[120px] rounded-full w-96 h-96 pointer-events-none"></div>
                    <img src="{{asset('img/logo-sipatuo.png')}}" alt="SIPATUO Logo" class="relative z-10 h-64 sm:h-80 md:h-[28rem] w-auto object-contain drop-shadow-[0_0_40px_rgba(59,130,246,0.7)] scale-110">
                </div>

                <!-- Logo serves as the main heading -->
                <p class="text-lg sm:text-xl font-medium text-slate-300 mb-6">
                    Sistem Informasi Pengaduan Aman Terenkripsi dengan Utamakan Otorisasi
                </p>

                <!-- Subheading -->
                <div class="max-w-4xl mx-auto mb-10">
                    <p class="text-xl sm:text-2xl text-slate-300 font-medium leading-relaxed">
                        <span class="text-blue-500 font-bold">Sipakatau</span> dalam Suara, 
                        <span class="text-amber-500 font-bold">Sipakalebbi</span> dalam Data, 
                        <span class="text-green-500 font-bold">Sipakainge</span> dalam Keadilan
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-400 hover:to-green-400 text-white font-bold rounded-xl shadow-2xl shadow-blue-500/30 hover:shadow-green-500/50 transition-all duration-300 hover:scale-105 text-center">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Buat Laporan Terenkripsi
                        </span>
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-slate-800/50 hover:bg-slate-700/50 backdrop-blur-sm text-white font-semibold rounded-xl border border-slate-700 hover:border-slate-600 transition-all duration-300 text-center">
                        Lihat Fitur Keamanan
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="flex flex-wrap items-center justify-center gap-8 text-sm text-slate-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="font-medium">Zero-Knowledge Architecture</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="font-medium">Blind Index Protected</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="font-medium">Audit Trail Encrypted</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="features" class="py-20 lg:py-32 bg-slate-950/50 backdrop-blur-sm relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-5xl font-black text-white mb-4 tracking-tight">Mengapa SIPATUO?</h2>
                <p class="text-lg text-slate-400">Sistem keamanan berlapis yang dirancang khusus untuk melindungi identitas pelapor</p>
            </div>

            <!-- Feature Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-blue-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Hybrid Encryption</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Kombinasi <code class="px-1.5 py-0.5 bg-blue-500/10 text-blue-400 rounded font-mono text-xs">AES-256-GCM</code> untuk kecepatan dan 
                            <code class="px-1.5 py-0.5 bg-cyan-500/10 text-cyan-400 rounded font-mono text-xs">RSA-2048</code> untuk keamanan kunci. 
                            Standar yang sama digunakan oleh bank & militer.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-purple-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/5 rounded-full blur-2xl group-hover:bg-purple-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center mb-6 shadow-lg shadow-purple-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Zero-Knowledge NIM</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            NIM tidak pernah tersimpan di database. Sistem menggunakan 
                            <code class="px-1.5 py-0.5 bg-purple-500/10 text-purple-400 rounded font-mono text-xs">SHA-256 Blind Index</code> — 
                            database bisa verifikasi login tanpa tahu identitas asli Anda.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-rose-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-rose-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-500/5 rounded-full blur-2xl group-hover:bg-rose-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-orange-500 flex items-center justify-center mb-6 shadow-lg shadow-rose-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Separation of Duties</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Admin IT <strong class="text-white">tidak bisa</strong> dekripsi data. 
                            Kunci privat hanya dipegang Satgas. Bahkan developer sistem tidak bisa baca isi laporan yang sudah dienkripsi.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-teal-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-teal-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/5 rounded-full blur-2xl group-hover:bg-teal-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-500 flex items-center justify-center mb-6 shadow-lg shadow-teal-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">File Encryption</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Lampiran bukti (PDF, gambar, ZIP) dienkripsi binary-level. 
                            Setiap file punya kunci AES unik + SHA-256 integrity check untuk deteksi manipulasi.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-amber-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-amber-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-yellow-500 flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Audit Trail</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Setiap aksi Satgas (view, download, status update) tercatat terenkripsi. 
                            Timestamp, IP, user agent — semua log dilindungi dari modifikasi.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="group relative bg-gradient-to-br from-slate-900 to-slate-800 p-8 rounded-2xl border border-slate-700 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/20 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-2xl group-hover:bg-indigo-500/10 transition-all duration-300"></div>
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center mb-6 shadow-lg shadow-indigo-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Anonymous Tracking</h3>
                        <p class="text-slate-400 leading-relaxed text-sm">
                            Lacak status laporan pakai UUID token tanpa login. 
                            Token ini tidak terhubung langsung ke identitas Anda di database.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECURITY ARCHITECTURE SECTION -->
    <section id="security" class="py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-950/30 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-black text-white mb-4 tracking-tight">Arsitektur 3-Layer Security</h2>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto">Sistem dirancang dengan pemisahan wewenang yang ketat untuk mencegah abuse of power</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Layer 1: Mahasiswa -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-transparent rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                    <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-700/50 hover:border-blue-500/50 rounded-3xl p-8 h-full flex flex-col transition-all duration-500 group-hover:-translate-y-2">
                        <div class="flex flex-col mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-blue-500/10 border border-blue-500/30 flex items-center justify-center text-blue-400 font-black text-2xl mb-5 shadow-[0_0_15px_rgba(59,130,246,0.2)]">1</div>
                            <h3 class="text-2xl font-black text-white tracking-tight mb-2">Mahasiswa</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Pelapor dapat membuat aduan secara anonim. Identitas murni dilindungi menggunakan fungsi hash satu arah yang tidak dapat dikembalikan.</p>
                        </div>
                        <ul class="space-y-5 text-sm flex-grow">
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-blue-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Registrasi akun menggunakan <strong class="text-white">NIM Blind Index</strong></span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-blue-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Mengirim laporan yang otomatis <strong class="text-white">ter-enkripsi hybrid</strong> (AES-256-GCM)</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-blue-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Memantau status laporan via UUID tanpa mengekspos identitas</span>
                            </li>
                        </ul>
                        <div class="mt-8 pt-6 border-t border-slate-700/50">
                            <div class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-3">Hak Akses Sistem</div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold rounded-xl w-full justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                READ: Laporan Sendiri
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layer 2: Satgas -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                    <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-700/50 hover:border-purple-500/50 rounded-3xl p-8 h-full flex flex-col transition-all duration-500 group-hover:-translate-y-2">
                        <div class="flex flex-col mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 font-black text-2xl mb-5 shadow-[0_0_15px_rgba(168,85,247,0.2)]">2</div>
                            <h3 class="text-2xl font-black text-white tracking-tight mb-2">Satgas</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Pihak berwenang yang ditugaskan memverifikasi aduan. Memegang otoritas penuh untuk membuka laporan rahasia menggunakan Private Key.</p>
                        </div>
                        <ul class="space-y-5 text-sm flex-grow">
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-purple-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed"><strong class="text-white">Dekripsi isi laporan</strong> menggunakan Private Key RSA 2048-bit</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-purple-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Memperbarui status tindak lanjut aduan</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-purple-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-purple-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Membuka paksa identitas pelapor (NIM) dengan <strong class="text-white">2FA PIN</strong> jika situasi darurat</span>
                            </li>
                        </ul>
                        <div class="mt-8 pt-6 border-t border-slate-700/50">
                            <div class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-3">Hak Akses Sistem</div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/10 border border-purple-500/20 text-purple-400 text-xs font-bold rounded-xl w-full justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg>
                                DECRYPT + WRITE
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layer 3: Admin -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-500/20 to-transparent rounded-3xl blur-xl group-hover:blur-2xl transition-all duration-500"></div>
                    <div class="relative bg-slate-900/60 backdrop-blur-xl border border-slate-700/50 hover:border-rose-500/50 rounded-3xl p-8 h-full flex flex-col transition-all duration-500 group-hover:-translate-y-2">
                        <div class="flex flex-col mb-8">
                            <div class="w-14 h-14 rounded-2xl bg-rose-500/10 border border-rose-500/30 flex items-center justify-center text-rose-400 font-black text-2xl mb-5 shadow-[0_0_15px_rgba(244,63,94,0.2)]">3</div>
                            <h3 class="text-2xl font-black text-white tracking-tight mb-2">Admin IT</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Pengelola server dan basis data. Memastikan sistem 24/7 online tanpa sedikitpun celah untuk mengintip isi aduan mahasiswa.</p>
                        </div>
                        <ul class="space-y-5 text-sm flex-grow">
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-rose-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-rose-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Mengelola manajemen akun Satgas (Buat, Blokir, Suspend)</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-rose-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-rose-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Memantau lalu lintas jaringan dan log server</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="mt-1 bg-rose-500/20 p-1 rounded-full"><svg class="w-4 h-4 text-rose-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="4"/></svg></div>
                                <span class="text-slate-300 leading-relaxed">Hanya dapat melihat ciphertext AES pada database</span>
                            </li>
                        </ul>
                        <div class="mt-8 pt-6 border-t border-slate-700/50">
                            <div class="text-[10px] text-slate-500 font-black uppercase tracking-widest mb-3">Hak Akses Sistem</div>
                            <div class="flex flex-col gap-2">
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 border border-slate-700 text-slate-300 text-xs font-bold rounded-xl w-full justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/></svg>
                                    INFRA ONLY
                                </div>
                                <div class="inline-flex items-center gap-2 px-4 py-2 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-bold rounded-xl w-full justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    DECRYPT: FORBIDDEN
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-cyan-600/10"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-5xl font-black text-white mb-6 tracking-tight">
                Siap Menyuarakan<br/>Kebenaran?
            </h2>
            <p class="text-lg text-slate-300 mb-10 max-w-2xl mx-auto">
                Daftarkan akun Anda sekarang dan mulai gunakan sistem pengaduan teraman di Indonesia.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-bold rounded-xl shadow-2xl shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:scale-105 text-lg">
                    Daftar Gratis Sekarang
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-5 bg-slate-800/50 hover:bg-slate-700/50 backdrop-blur-sm text-white font-semibold rounded-xl border border-slate-700 hover:border-slate-600 transition-all duration-300 text-lg">
                    Sudah Punya Akun
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-slate-800 bg-slate-950/90 backdrop-blur-sm py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <img src="{{asset('img/Logo Ilmu Komputer ITH.png')}}" alt="Ilmu Komputer ITH" class="h-10 w-auto object-contain drop-shadow-md">
                    
                    <img src="{{asset('img/logo-sipatuo.png')}}" alt="SIPATUO" class="h-10 w-auto object-contain drop-shadow-[0_0_10px_rgba(14,165,233,0.3)] opacity-90">
                    
                    <div class="flex flex-col ml-1">
                        <span class="text-base font-bold text-white tracking-tight">SIPATUO</span>
                        <span class="text-[10px] text-slate-400 uppercase tracking-widest">Ilmu Komputer ITH</span>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-6 text-sm text-slate-400">
                    <a href="{{ route('pages.tentang') }}" class="hover:text-white transition-colors">Tentang</a>
                    <a href="{{ route('pages.privasi') }}" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="{{ route('pages.syarat') }}" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    <a href="{{ route('pages.kontak') }}" class="hover:text-white transition-colors">Kontak</a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-500">
                    © 2026 Institut Teknologi BJ Habibie. Sistem Pengaduan Terenkripsi.
                    <span class="mx-2">•</span>
                    <code class="px-2 py-1 bg-slate-900 text-cyan-400 rounded font-mono">AES-256-GCM + RSA-2048</code>
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
