<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsBimbel
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'bimbel' atau admin/mentor untuk mengakses portal bimbel EduPulse.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Admin/mentor juga memiliki privilege akses
        if (!$user->isBimbel() && !$user->isAdminOrMentor()) {
            if ($user->isBengkel()) {
                return redirect()->route('bengkel.dashboard')->with('error', 'Anda tidak memiliki akses ke portal Bimbel EduPulse.');
            }
            if ($user->isPklStudent()) {
                return redirect()->route('pkl.dashboard')->with('error', 'Anda tidak memiliki akses ke portal Bimbel EduPulse.');
            }
            return redirect()->route('member.dashboard')->with('error', 'Anda tidak memiliki akses ke portal Bimbel EduPulse.');
        }

        return $next($request);
    }
}
