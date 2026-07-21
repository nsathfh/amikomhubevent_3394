<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login (auth()->check())
        // 2. Cek apakah role dari pengguna yang login adalah 'admin'
        // Jika salah satu kondisi tidak terpenuhi, batalkan request dan kirim respon 403 Forbidden.
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'organizer'])) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Administrator atau Penyelenggara.');
        }

        // Jika lolos pengecekan, lanjutkan request ke proses selanjutnya
        return $next($request);
    }
}
