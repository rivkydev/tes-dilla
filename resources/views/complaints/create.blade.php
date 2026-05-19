<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-6">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-cyan-400">Kirim Pengaduan Baru</h1>
                <p class="text-slate-400 text-sm">Seluruh kolom sensitif akan otomatis dienkripsi secara hibrida (AES-GCM + RSA)</p>
            </div>
            <a href="{{ route('complaints.index') }}" class="text-sm bg-slate-800 border border-slate-700 px-4 py-2 rounded-lg hover:bg-slate-700 transition">Kembali</a>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-4 rounded-xl text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-800 p-8 rounded-2xl border border-slate-700 space-y-6 shadow-xl">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Nama Lengkap Anda</label>
                    <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Kontak / No. WhatsApp</label>
                    <input type="text" name="contact" placeholder="08XXXXXXXXXX" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Kategori Masalah</label>
                <select name="category" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Akademik">Fasilitas & Akademik</option>
                    <option value="Pungli">Laporan Pungutan Liar (Pungli)</option>
                    <option value="Pelecehan">Tindakan Pelecehan / Perundungan</option>
                    <option value="Infrastruktur">Sistem IT & Infrastruktur Kampus</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Isi Laporan Kronologi Masalah</label>
                <textarea name="content" rows="6" placeholder="Ketik kronologi masalah secara mendetail..." required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">File Bukti Pendukung (Maksimal 5 File, Maks 10MB per file)</label>
                <input type="file" name="files[]" multiple class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2 text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                <p class="text-xs text-slate-500 mt-2">Format yang diizinkan: JPG, PNG, PDF, TXT, ZIP. File biner akan dienkripsi penuh di sisi server.</p>
            </div>

            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-bold py-3 rounded-lg transition shadow-lg shadow-cyan-500/20">
                Kunci & Kirim Laporan Pengaduan
            </button>
        </form>
    </div>
</body>
</html>