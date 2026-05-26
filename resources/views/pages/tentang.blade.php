<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Sistem - SIPATUO</title>
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
        <h1 class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500 mb-8">Tentang SIPATUO</h1>
        
        <div class="prose prose-invert prose-slate max-w-none space-y-6 text-slate-300 leading-relaxed">
            <p>
                <strong>SIPATUO</strong> (Sistem Informasi Pengaduan Aman Terenkripsi dengan Utamakan Otorisasi) adalah platform pengaduan mahasiswa generasi terbaru yang dikembangkan secara eksklusif untuk lingkungan kampus.
            </p>
            <p>
                Mengambil filosofi budaya Bugis: <em>"Sipakatau, Sipakalebbi, Sipakainge"</em>, sistem ini tidak hanya bertujuan sebagai sarana pelaporan, melainkan sebagai ruang aman (safe space) yang mengutamakan kerahasiaan identitas dan menjunjung tinggi kehormatan pelapor maupun terlapor hingga ada pembuktian yang jelas.
            </p>
            
            <h2 class="text-2xl font-bold text-white mt-10 mb-4">Visi & Misi</h2>
            <ul class="list-disc pl-6 space-y-2">
                <li>Menciptakan lingkungan kampus yang bebas dari kekerasan, pelecehan, dan penyalahgunaan wewenang.</li>
                <li>Memberikan jaminan teknis bahwa setiap laporan tidak dapat diintervensi oleh pihak yang tidak berwenang, bahkan oleh administrator sistem sekalipun.</li>
                <li>Meningkatkan keberanian mahasiswa untuk bersuara melalui proteksi kriptografi asimetris (RSA-2048).</li>
            </ul>

            <div class="mt-12 p-6 bg-slate-900 border border-slate-800 rounded-2xl">
                <h3 class="text-lg font-bold text-white mb-2">Zero-Knowledge Architecture</h3>
                <p class="text-sm">
                    Sistem dibangun dengan prinsip <em>Zero-Knowledge</em>. Hal ini berarti database kami hanya menyimpan teks acak (ciphertext) dan tidak mengetahui siapa Anda atau apa isi laporan Anda tanpa menggunakan Kunci Privat yang hanya dimiliki oleh otoritas Satgas.
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-950 py-8 text-center text-sm text-slate-500 mt-auto">
        &copy; 2026 SIPATUO. All rights reserved.
    </footer>
</body>
</html>
