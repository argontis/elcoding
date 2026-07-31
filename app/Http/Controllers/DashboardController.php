<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProgramKursus;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // 1. QUERY DATA STATISTIK DARI DATABASE
        $totalStudents = User::count(); 

        $activeCourses = ProgramKursus::count();
        
        $totalRevenue = 0;
        
        $pendingConsultations = 0;

        // 2. QUERY AKTIVITAS TERBARU (5 DATA TERAKHIR)
        $recentActivities = collect([]);

        // 3. KIRIM DATA KE DASHBOARD REACT
        return Inertia::render('Dashboard', [
            'stats' => [
                'total_students'        => number_format($totalStudents),
                'active_courses'        => (string) $activeCourses,
                'total_revenue'         => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
                'pending_consultations' => (string) $pendingConsultations,
            ],
            'activities' => $recentActivities,
            'systemStatus' => [
                'uptime'  => '99.9%',
                'storage' => '64.2 GB / 100 GB',
            ],
        ]);
    }
}