<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengaduan Mahasiswa Terenkripsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased selection:bg-cyan-500 selection:text-slate-950">

    <nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">🛡️ SafeReport</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('complaints.track_form') }}" class="text-sm text-slate-400 hover:text-white transition">Lacak Aduan</a>
                <a href="{{ route('login') }}" class="bg-slate-800 border border-slate-700 hover:bg-slate-700 text-slate-100 px-4 py-2 rounded-xl text-sm font-semibold transition">Masuk</a>
                <a href="{{ route('register') }}" class="bg-cyan-500 hover:bg-cyan-600 text-slate-950 px-4 py-2 rounded-xl text-sm font-bold transition shadow-lg shadow-cyan-500/20">Daftar</a>
            </div>
        </div>
    </nav>

    <header class="relative overflow-hidden py-24 lg:py-32 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span> Standar Kriptografi Militer & Industri
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-white tracking-tight max-w-3xl mx-auto leading-tight">
                Suarakan Keluhan Anda Tanpa Rasa Takut.
            </h1>
            <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Platform pengaduan kampus pertama yang mengintegrasikan <strong class="text-slate-200">Hybrid Encryption (AES-256-GCM + RSA-2048)</strong>. Identitas dan berkas Anda dikunci langsung dari perangkat Anda.
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('complaints.create') }}" class="bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-bold px-8 py-4 rounded-xl transition shadow-lg shadow-cyan-500/20 text-lg">
                    Kirim Aduan Terenkripsi
                </a>
            </div>
        </div>
    </header>

    <section class="py-20 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-white tracking-tight">Mengapa Situs Ini Benar-Benar Aman?</h2>
                <p class="mt-4 text-slate-400">Arsitektur keamanan end-to-end dirancang agar tidak ada satu pun pihak luar yang dapat memanipulasi atau mengintip laporan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-slate-900 border border-slate-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 text-2xl font-bold mb-6">🔑</div>
                    <h3 class="text-lg font-bold text-white mb-2">Hybrid Encryption</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Isi laporan dienkripsi secara instan menggunakan kunci simetris <span class="text-cyan-400 font-mono">AES-256-GCM</span>, lalu kunci pengunci tersebut dibungkus ulang menggunakan kunci asimetris <span class="text-cyan-400 font-mono">RSA-2048</span> milik Satgas.
                    </p>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 text-2xl font-bold mb-6">👁️</div>
                    <h3 class="text-lg font-bold text-white mb-2">Zero-Knowledge NIM</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        NIM Anda tidak disimpan dalam bentuk teks biasa. Sistem menggunakan teknik <span class="text-cyan-400 font-mono">Blind Index (SHA-256)</span> sehingga database bisa melakukan otentikasi login tanpa mengetahui identitas asli Anda.
                    </p>
                </div>

                <div class="bg-slate-900 border border-slate-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 flex items-center justify-center text-cyan-400 text-2xl font-bold mb-6">🚫</div>
                    <h3 class="text-lg font-bold text-white mb-2">Pemisahan Hak Akses</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Admin Pengelola IT hanya bisa mengelola akun sistem dan dilarang keras secara arsitektur kode untuk melakukan dekripsi data maupun melihat isi pengaduan. Hak dekripsi mutlak di tangan Satgas.
                    </p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>