<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-700">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-cyan-400">Sistem Pengaduan Mahasiswa</h1>
            <p class="text-slate-400 text-sm mt-2">Gunakan kredensial Anda untuk masuk</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500 text-emerald-400 p-3 rounded-lg text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-rose-500/10 border border-rose-500 text-rose-400 p-3 rounded-lg text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">NIM / Identitas Admin</label>
                <input type="text" name="nim" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-700 rounded-lg px-4 py-2.5 text-slate-100 focus:outline-none focus:border-cyan-500 transition">
            </div>
            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-slate-950 font-semibold py-2.5 rounded-lg transition shadow-lg shadow-cyan-500/20">
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-400 space-y-2">
            <p>Belum punya akun? <a href="{{ route('register') }}" class="text-cyan-400 hover:underline">Registrasi Mahasiswa</a></p>
            <p><a href="{{ route('complaints.track_form') }}" class="text-slate-400 hover:text-slate-200 underline text-xs">Lacak Pengaduan via Token Anonim</a></p>
        </div>
    </div>
</body>
</html>