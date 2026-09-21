<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Handle nomor kartu login
        if ($request->input('login_method') === 'kartu') {
            $request->validate([
                'nomor_kartu' => ['required', 'string'],
            ]);

            // Try to find in User model first (check both nomor_kartu and rfid_uid)
            $user = \App\Models\User::where('nomor_kartu', $request->nomor_kartu)
                                    ->orWhere('rfid_uid', $request->nomor_kartu)
                                    ->first();

            if ($user) {
                Auth::guard('web')->login($user);
                $request->session()->regenerate();

                if ($user->isAdminOrMentor()) {
                    $intended = $request->session()->pull('url.intended');
                    if (!$intended || str_contains($intended, '/pkl') || str_contains($intended, '/member') || str_contains($intended, '/login') || str_contains($intended, '/register')) {
                        $intended = route('dashboard');
                    }
                    return Inertia::location($intended);
                }

                if ($user->isPklStudent()) {
                    $hasCourse = \App\Models\Order::where('user_email', $user->email)->where('status', 'PAID')->exists();
                    $hasEvent = \App\Models\EventOrder::where('user_email', $user->email)->where('status', 'PAID')->exists();
                    if ($hasCourse || $hasEvent) {
                        $intended = $request->session()->pull('url.intended');
                        if (!$intended || str_contains($intended, '/admin') || str_contains($intended, '/member') || str_contains($intended, '/login') || str_contains($intended, '/register')) {
                            $intended = route('pkl.dashboard');
                        }
                        return Inertia::location($intended);
                    }
                }

                return Inertia::location(route('member.dashboard'));
            }

            // Fallback to Member model
            $member = \App\Models\Member::where('nomor_kartu', $request->nomor_kartu)->first();

            if (!$member) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'nomor_kartu' => 'Nomor kartu tidak ditemukan.',
                ]);
            }

            Auth::guard('member')->login($member);
            $request->session()->regenerate();

            return Inertia::location(route('member.dashboard'));
        }

        // Handle normal credential login
        $loginRequest = app(LoginRequest::class);
        $loginRequest->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->isAdminOrMentor()) {
            $intended = $request->session()->pull('url.intended');
            if (!$intended || str_contains($intended, '/pkl') || str_contains($intended, '/member') || str_contains($intended, '/login') || str_contains($intended, '/register')) {
                $intended = route('dashboard');
            }
            return Inertia::location($intended);
        }

        if ($user->isPklStudent()) {
            $hasCourse = \App\Models\Order::where('user_email', $user->email)->where('status', 'PAID')->exists();
            $hasEvent = \App\Models\EventOrder::where('user_email', $user->email)->where('status', 'PAID')->exists();
            if ($hasCourse || $hasEvent) {
                $intended = $request->session()->pull('url.intended');
                if (!$intended || str_contains($intended, '/admin') || str_contains($intended, '/member') || str_contains($intended, '/login') || str_contains($intended, '/register')) {
                    $intended = route('pkl.dashboard');
                }
                return Inertia::location($intended);
            }
        }

        return Inertia::location(route('member.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Inertia::location('/');
    }
}
