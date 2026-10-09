<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPklAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Jika user memiliki role khusus SaaS, alihkan ke dashboard masing-masing
        if ($user && $user->isTechfix()) {
            return redirect('/techfix/dashboard');
        }
        if ($user && $user->isBengkel()) {
            return redirect('/bengkel/dashboard');
        }
        if ($user && $user->isBimbel()) {
            return redirect('/bimbel/dashboard');
        }
        if ($user && $user->isResto()) {
            return redirect('/resto/dashboard');
        }
        if ($user && ($user->isKlinik() || strtolower(trim($user->role ?? '')) === 'klinik')) {
            return redirect('/klinik/dashboard');
        }

        return $next($request);
    }
}
