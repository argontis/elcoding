<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
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
