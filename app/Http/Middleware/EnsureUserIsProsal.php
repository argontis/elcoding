<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsProsal
{
    /**
     * Handle an incoming request.
     * Mengizinkan user dengan role 'prosal' atau admin untuk mengakses portal L-Prosal.
     * Jika pengunjung belum login, tetap diizinkan dalam mode pratinjau demo.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            if (!$user->isProsal() && !$user->isAdminOrMentor()) {
                return redirect('/dashboard')->with('error', 'Akun Anda tidak memiliki hak akses langganan L-Prosal.');
            }
        }

        return $next($request);
    }
}

