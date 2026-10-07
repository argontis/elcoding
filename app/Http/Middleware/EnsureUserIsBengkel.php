<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsBengkel
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'bengkel' atau admin untuk mengakses portal bengkel.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin juga boleh masuk ke bengkel dashboard
        if (!$user->isBengkel() && !$user->isAdminOrMentor()) {
            if ($user->isPklStudent()) {
                return redirect()->route('pkl.dashboard')->with('error', 'Anda tidak memiliki akses ke portal bengkel.');
            }
            return redirect()->route('member.dashboard')->with('error', 'Anda tidak memiliki akses ke portal bengkel.');
        }

        return $next($request);
    }
}
