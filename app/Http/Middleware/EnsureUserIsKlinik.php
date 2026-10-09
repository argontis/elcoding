<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsKlinik
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'klinik' atau admin untuk mengakses portal Klinik.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin atau Klinik boleh masuk ke klinik dashboard
        if (!method_exists($user, 'isKlinikOrAdmin') ? (strtolower(trim($user->role ?? '')) !== 'klinik' && !$user->isAdminOrMentor()) : !$user->isKlinikOrAdmin()) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke portal Klinik.');
        }

        return $next($request);
    }
}
