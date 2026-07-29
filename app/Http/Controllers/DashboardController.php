<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Transaction;    // Sesuaikan dengan nama Model kamu
use App\Models\Consultation;   // Sesuaikan dengan nama Model kamu
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // 1. QUERY DATA STATISTIK DARI DATABASE
        $totalStudents = User::where('role', 'student')->count(); 
        // Jika tidak ada kolom role, bisa pakai: User::count();

        $activeCourses = Course::where('is_active', true)->count();
        
        $totalRevenue = Transaction::where('status', 'success')->sum('amount');
        
        $pendingConsultations = Consultation::where('status', 'pending')->count();

        // 2. QUERY AKTIVITAS TERBARU (5 DATA TERAKHIR)
        $recentActivities = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                return [
                    'id'          => $item->id,
                    'title'       => $item->user->name . ' mendaftar ' . $item->course_title,
                    'subtitle'    => 'Pendaftaran Kursus',
                    'status'      => $item->status === 'success' ? 'Success' : 'Pending Review',
                    'statusType'  => $item->status === 'success' ? 'success' : 'warning',
                    'timestamp'   => $item->created_at->diffForHumans(), // Contoh: "2 mins ago"
                ];
            });

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