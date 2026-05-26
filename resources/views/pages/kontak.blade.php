<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - SIPATUO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-200 antialiased font-sans min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{asset('img/logo-sipatuo.png')}}" alt="SIPATUO" class="h-10 w-auto object-contain drop-shadow-[0_0_15px_rgba(14,165,233,0.4)]">
                <span class="text-xl font-bold text-white tracking-tight">SIPATUO</span>
            </a>
            <a href="{{ url('/') }}" class="text-sm font-medium text-slate-400 hover:text-white transition">Kembali ke Beranda</a>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
        <h1 class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500 mb-8">Pusat Bantuan & Kontak</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
            <!-- Card 1 -->
            <div class="bg-slate-900 border border-slate-800 p-8 rounded-3xl">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Bantuan Teknis (IT)</h3>
                <p class="text-sm text-slate-400 mb-6">Jika Anda mengalami kendala teknis saat mendaftar atau gagal memuat sistem kriptografi, hubungi tim IT kami.</p>
                <div class="flex flex-col gap-2 font-mono text-sm">
                    <span class="text-slate-300">Email: <a href="mailto:it.support@ith.ac.id" class="text-emerald-400 hover:underline">it.support@ith.ac.id</a></span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-slate-900 border border-slate-800 p-8 rounded-3xl">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Layanan Konseling Khusus</h3>
                <p class="text-sm text-slate-400 mb-6">Bagi Anda yang merasa terancam atau membutuhkan pendampingan psikologis mendesak terkait aduan yang diajukan.</p>
                <div class="flex flex-col gap-2 font-mono text-sm">
                    <span class="text-slate-300">Hotline: <span class="text-blue-400">0811-XXXX-XXXX</span></span>
                    <span class="text-slate-500 text-xs mt-1">(Tersedia pada jam kerja)</span>
                </div>
            </div>
        </div>

        <div class="mt-12 p-6 bg-slate-900/50 border border-slate-800 rounded-2xl text-center">
            <h3 class="font-bold text-white mb-2">Alamat Sekretariat Satgas Kampus</h3>
            <p class="text-sm text-slate-400">Gedung Rektorat Institut Teknologi BJ Habibie<br/>Jln. Pendidikan No. X, Kota Parepare, Sulawesi Selatan</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-950 py-8 text-center text-sm text-slate-500 mt-auto">
        &copy; 2026 SIPATUO. All rights reserved.
    </footer>
</body>
</html>
