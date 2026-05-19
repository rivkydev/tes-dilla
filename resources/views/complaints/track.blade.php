<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pengaduan Anonim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-700">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-cyan-400">Pelacakan Anonim</h1>
            <p class="text-slate-400 text-sm mt-2">Masukkan kode resi UUID untuk melihat progres kasus</p>
        </div>

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-3 rounded-lg text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('complaints.track_process') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Kode Resi UUID Pengaduan</label>
                <input type="text" name="token" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-center font-mono text-cyan-400 focus:outline-none focus:border-cyan-500 transition text-sm">
            </div>
            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-semibold py-2.5 rounded-lg transition shadow-lg">
                Cari Data Pengaduan
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-400">
            <a href="{{ route('login') }}" class="text-slate-400 hover:text-slate-200 underline">Kembali ke Menu Login Utama</a>
        </div>
    </div>
</body>
</html>