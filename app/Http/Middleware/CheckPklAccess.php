<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
use App\Models\EventOrder;

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

        // Admin dan mentor selalu punya akses
        if ($user->role === 'admin' || $user->role === 'mentor') {
            return $next($request);
        }

        // Cek apakah email user ini ada di orders (Program Kursus) dengan status PAID
        $hasCourse = Order::where('user_email', $user->email)
                          ->whereIn('status', ['paid', 'PAID', 'SETTLED'])
                          ->exists();

        // Cek apakah email user ini ada di event_orders (Event/Webinar) dengan status PAID
        $hasEvent = EventOrder::where('user_email', $user->email)
                              ->whereIn('status', ['paid', 'PAID', 'SETTLED'])
                              ->exists();

        if ($hasCourse || $hasEvent) {
            return $next($request);
        }

        // Jika tidak punya keduanya, blokir dan arahkan ke halaman program kursus
        return redirect('/program-kursus')->with('error', 'Akses Ditolak: Anda harus membeli Program Kursus atau mendaftar Event terlebih dahulu untuk mengakses Dashboard PKL/Magang.');
    }
}
