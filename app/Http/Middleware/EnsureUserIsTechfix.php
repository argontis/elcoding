<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTechfix
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'techfix' atau admin untuk mengakses portal TechFix Pro.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin juga boleh masuk ke techfix dashboard
        if (!$user->isTechfix() && !$user->isAdminOrMentor()) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke portal TechFix Pro.');
        }

        return $next($request);
    }
}
