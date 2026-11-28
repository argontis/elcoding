<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSeminarParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isAdminOrMentor()) {
            return redirect('/dashboard');
        }
        if ($user->isTechfix()) {
            return redirect('/techfix/dashboard');
        }
        if ($user->isBengkel()) {
            return redirect('/bengkel/dashboard');
        }
        if ($user->isBimbel()) {
            return redirect('/bimbel/dashboard');
        }
        if ($user->isResto()) {
            return redirect('/resto/dashboard');
        }
        if ($user->isKlinik() || strtolower(trim($user->role ?? '')) === 'klinik') {
            return redirect('/klinik/dashboard');
        }
        if ($user->isPklStudent()) {
            return redirect()->route('pkl.dashboard');
        }
        if ($user->isPendingRole()) {
            return redirect()->route('register.choose-role');
        }
        if (!$user->isSeminarParticipant()) {
            return redirect()->route('member.dashboard');
        }

        if (!$user->seminarProfile) {
            return redirect()->route('register.seminar');
        }

        return $next($request);
    }
}
