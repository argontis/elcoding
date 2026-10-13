<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCrmLead
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'crmlead' atau admin untuk mengakses dashboard AI CRM & Lead Management.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if (!method_exists($user, 'isCrmLeadOrAdmin') ? (strtolower(trim($user->role ?? '')) !== 'crmlead' && !$user->isAdminOrMentor()) : !$user->isCrmLeadOrAdmin()) {
            return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke portal AI CRM & Lead Management.');
        }

        return $next($request);
    }
}
