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

            $member = \App\Models\Member::where('nomor_kartu', $request->nomor_kartu)->first();

            if (!$member) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'nomor_kartu' => 'Nomor kartu tidak ditemukan.',
                ]);
            }

            Auth::guard('member')->login($member);
            $request->session()->regenerate();

            return Inertia::location('/member/dashboard');
        }

        // Handle normal credential login
        $loginRequest = app(LoginRequest::class);
        $loginRequest->authenticate();

        $request->session()->regenerate();

        if (!$request->user()->isAdminOrMentor()) {
            return Inertia::location(route('pkl.dashboard'));
        }

        $intended = $request->session()->pull('url.intended', '/admin');
        return Inertia::location($intended);
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
