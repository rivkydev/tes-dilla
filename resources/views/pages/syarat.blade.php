<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan - SIPATUO</title>
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
        <h1 class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500 mb-8">Syarat & Ketentuan Layanan</h1>
        
        <div class="prose prose-invert prose-slate max-w-none space-y-8 text-slate-300 leading-relaxed">
            <p>
                Dengan mendaftar dan menggunakan sistem pengaduan SIPATUO, Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan di bawah ini.
            </p>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">Pasal 1: Ketepatan Informasi</h2>
                <p>
                    Pelapor wajib memberikan informasi, kronologi, dan bukti lampiran yang sebenar-benarnya dan dapat dipertanggungjawabkan. Pelaporan palsu atau fitnah dapat menyebabkan penangguhan akun secara permanen.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">Pasal 2: Kerahasiaan Resi (UUID)</h2>
                <p>
                    Segera setelah mengirimkan laporan, Anda akan menerima Kode Resi (UUID). Kode ini adalah satu-satunya cara untuk melacak status laporan Anda secara anonim. Anda bertanggung jawab penuh untuk menyimpan kode tersebut dengan aman dan tidak membagikannya kepada pihak yang tidak berkepentingan.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">Pasal 3: Tanggung Jawab Satgas</h2>
                <p>
                    Pihak Satgas berkewajiban merespons dan menindaklanjuti setiap aduan dalam waktu 3x24 jam kerja. Satgas dilarang keras menyebarluaskan dokumen atau identitas (jika diungkap karena urgensi) kepada pihak eksternal tanpa izin otoritas terkait.
                </p>
            </div>

            <div class="p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl text-amber-400 text-sm">
                <strong>Catatan Penting:</strong> Sistem SIPATUO tidak dapat memulihkan (recovery) laporan Anda jika Anda kehilangan akun atau lupa dengan Kode Resi UUID, dikarenakan arsitektur enkripsi end-to-end yang mengunci data Anda dari pihak admin.
            </div>
            
            <div class="mt-8 pt-8 border-t border-slate-800 text-sm text-slate-500">
                Pembaruan Terakhir: Mei 2026
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-950 py-8 text-center text-sm text-slate-500 mt-auto">
        &copy; 2026 SIPATUO. All rights reserved.
    </footer>
</body>
</html>
