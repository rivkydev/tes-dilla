<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login dan memiliki role 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, lempar kembali ke halaman login dengan pesan error keamanan
        return redirect()->route('login')->withErrors([
            'nim' => 'Akses ditolak! Halaman tersebut hanya dapat diakses oleh Admin berwenang.'
        ]);
    }
}