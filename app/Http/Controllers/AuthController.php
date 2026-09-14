<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $loginMethod = $request->input('login_method', 'credential');

        if ($loginMethod === 'kartu') {
            return $this->loginWithKartu($request);
        }

        return $this->loginWithCredential($request);
    }

    /**
     * Login with username + password (existing method)
     */
    protected function loginWithCredential(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            \App\Models\ActivityLog::add(
                'Autentikasi', 
                'Admin Login', 
                'Admin berhasil masuk ke dalam sistem dari alamat IP: ' . $request->ip(),
                'green',
                'fa-sign-in-alt'
            );
            
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Login with nomor kartu only (no password)
     */
    protected function loginWithKartu(Request $request)
    {
        $request->validate([
            'nomor_kartu' => ['required', 'string'],
        ]);

        $member = \App\Models\Member::where('nomor_kartu', $request->nomor_kartu)->first();

        if (!$member) {
            return back()->withErrors([
                'nomor_kartu' => 'Nomor kartu tidak ditemukan.',
            ])->onlyInput('nomor_kartu');
        }

        Auth::guard('member')->login($member);
        $request->session()->regenerate();

        \App\Models\ActivityLog::add(
            'Autentikasi', 
            'Login Kartu', 
            'Login via nomor kartu (' . $request->nomor_kartu . ') dari IP: ' . $request->ip(),
            'green',
            'fa-id-card'
        );

        return redirect('/member/dashboard');
    }

    public function logout(Request $request)
    {
        \App\Models\ActivityLog::add(
            'Autentikasi', 
            'Admin Logout', 
            'Admin telah keluar dari sistem.',
            'slate',
            'fa-sign-out-alt'
        );

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
