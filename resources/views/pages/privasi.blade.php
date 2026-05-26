<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - SIPATUO</title>
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
        <h1 class="text-3xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500 mb-8">Kebijakan Privasi</h1>
        
        <div class="prose prose-invert prose-slate max-w-none space-y-8 text-slate-300 leading-relaxed">
            <p>
                Privasi dan keamanan data Anda adalah pondasi utama dari sistem SIPATUO. Dokumen ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi data Anda secara kriptografis.
            </p>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">1. Pengumpulan Identitas (Blind Indexing)</h2>
                <p>
                    Saat Anda mendaftar menggunakan NIM, sistem <strong>tidak pernah menyimpan NIM Anda dalam bentuk teks asli</strong>. Kami menggunakan fungsi <em>Hash SHA-256</em> searah. Ini berarti identitas Anda diubah menjadi deretan karakter acak yang tidak dapat diubah kembali menjadi NIM asli oleh siapapun, termasuk kami.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">2. Isi Laporan dan Lampiran</h2>
                <p>
                    Segala bentuk rincian aduan, teks, dan file bukti yang Anda unggah akan secara otomatis dienkripsi di perangkat atau server menggunakan algoritma <strong>AES-256-GCM</strong> sebelum disimpan ke pangkalan data (database).
                </p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">3. Siapa yang Bisa Membaca Laporan Anda?</h2>
                <p>
                    Hanya pihak berwenang (Satgas Kampus) yang telah ditunjuk dan memegang <strong>Private Key RSA (Kunci Privat)</strong> yang memiliki kemampuan teknis untuk membaca isi laporan Anda. Admin IT dan pengembang sistem secara teknis diblokir dari kemampuan mendekripsi data ini.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-bold text-white mb-2">4. Log Aktivitas (Audit Trail)</h2>
                <p>
                    Sistem tidak melacak alamat IP mahasiswa pelapor untuk memastikan anonimitas maksimal. Namun, sistem melacak dengan sangat ketat setiap aktivitas akses dan dekripsi yang dilakukan oleh akun Satgas untuk mencegah penyalahgunaan wewenang (abuse of power).
                </p>
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
