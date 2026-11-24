<?php

namespace App\Http\Controllers\Barbershop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BarbershopDashboardController extends Controller
{
    protected function getAuthUser()
    {
        return auth()->user() ?? (object)[
            'id' => 1,
            'name' => 'Raditya Pratama',
            'email' => 'raditya@lstyle.id',
            'role' => 'admin',
        ];
    }

    /**
     * Display the L-Style Atelier Suite Barbershop Dashboard.
     */
    public function index(Request $request)
    {
        return Inertia::render('Atelier/Dashboard', [
            'auth' => [
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
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
                'user' => $this->getAuthUser(),
            ]
        ]);
    }
}

