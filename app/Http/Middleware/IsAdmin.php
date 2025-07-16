<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Periksa apakah pengguna sudah login DAN memiliki peran 'admin'.
        if (Auth::check() && Auth::user()->role == 'admin') {
            // 2. Jika ya, izinkan untuk melanjutkan ke halaman tujuan.
            return $next($request);
        }

        // 3. Jika tidak, tolak dan arahkan kembali ke halaman utama.
        // Anda juga bisa mengarahkannya ke halaman login jika mau.
        return redirect('/')->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}