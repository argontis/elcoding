<?php

namespace App\Http\Controllers\Barbershop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BarbershopDashboardController extends Controller
{
    /**
     * Display the L-Style Atelier Suite Barbershop Dashboard.
     */
    public function index(Request $request)
    {
        return Inertia::render('Atelier/Dashboard', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Jadwal & Reservasi Booking page.
     */
    public function booking(Request $request)
    {
        return Inertia::render('Atelier/Booking', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Database Pelanggan & Profil VIP page.
     */
    public function pelanggan(Request $request)
    {
        return Inertia::render('Atelier/Pelanggan', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Live Antrean Atelier page.
     */
    public function antrean(Request $request)
    {
        return Inertia::render('Atelier/Antrean', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Program Loyalitas & Sovereign Membership page.
     */
    public function membership(Request $request)
    {
        return Inertia::render('Atelier/Membership', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Katalog Treatment & Manajemen Layanan page.
     */
    public function treatment(Request $request)
    {
        return Inertia::render('Atelier/Treatment', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Kasir & POS Billing Live page.
     */
    public function kasir(Request $request)
    {
        return Inertia::render('Atelier/Kasir', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Komisi Pegawai & Kinerja Stylist page.
     */
    public function komisi(Request $request)
    {
        return Inertia::render('Atelier/Komisi', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }

    /**
     * Display the Automasi Reminder & WhatsApp Marketing page.
     */
    public function reminder(Request $request)
    {
        return Inertia::render('Atelier/Reminder', [
            'auth' => [
                'user' => auth()->user(),
            ]
        ]);
    }
}

