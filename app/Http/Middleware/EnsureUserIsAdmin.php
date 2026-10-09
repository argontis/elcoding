<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdminOrMentor()) {
            if (auth()->user()->isKlinik()) {
                return redirect()->route('klinik.dashboard');
            }
            if (auth()->user()->isBengkel()) {
                return redirect()->route('bengkel.dashboard');
            }
            if (auth()->user()->isBimbel()) {
                return redirect()->route('bimbel.dashboard');
            }
            if (auth()->user()->isResto()) {
                return redirect()->route('resto.dashboard');
            }
            if (auth()->user()->isTechfix()) {
                return redirect()->route('techfix.dashboard');
            }
            if (auth()->user()->isPklStudent()) {
                return redirect()->route('pkl.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
            }
            return redirect()->route('member.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}
