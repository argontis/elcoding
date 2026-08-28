<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\EventOrder;
use App\Models\LayananOrder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari 3 tabel (menggunakan Eloquent/DB Query Builder)
        // Kita gabungkan menjadi satu collection
        $orders = DB::table('orders')
            ->select('user_email', 'user_name', 'amount', 'created_at', 'status')
            ->whereIn('status', ['PAID', 'success', 'paid'])
            ->get();

        $eventOrders = DB::table('event_orders')
            ->select('user_email', 'user_name', 'amount', 'created_at', 'status')
            ->whereIn('status', ['PAID', 'success', 'paid'])
            ->get();

        $layananOrders = DB::table('layanan_orders')
            ->select('user_email', 'user_name', 'amount', 'created_at', 'status')
            ->whereIn('status', ['PAID', 'success', 'paid'])
            ->get();

        // 2. Gabungkan data
        $allTransactions = $orders->concat($eventOrders)->concat($layananOrders);

        // 3. Kelompokkan berdasarkan email pelanggan
        $customers = [];
        $now = Carbon::now();

        foreach ($allTransactions as $tx) {
            $email = $tx->user_email;
            if (!isset($customers[$email])) {
                $customers[$email] = [
                    'name' => $tx->user_name,
                    'email' => $email,
                    'total_spent' => 0,
                    'total_orders' => 0,
                    'last_order_date' => null,
                ];
            }

            $customers[$email]['total_spent'] += $tx->amount;
            $customers[$email]['total_orders'] += 1;

            $txDate = Carbon::parse($tx->created_at);
            if ($customers[$email]['last_order_date'] === null || $txDate->greaterThan($customers[$email]['last_order_date'])) {
                $customers[$email]['last_order_date'] = $txDate;
            }
        }

        // 4. Hitung Recency, Frequency, Monetary (RFM Raw Values)
        $rfmRaw = [];
        foreach ($customers as $email => $data) {
            $recencyDays = $now->diffInDays($data['last_order_date']);
            $rfmRaw[] = [
                'name' => $data['name'],
                'email' => $data['email'],
                'recency_days' => $recencyDays, // Lower is better
                'frequency' => $data['total_orders'], // Higher is better
                'monetary' => $data['total_spent'], // Higher is better
                'last_order_date' => $data['last_order_date']->format('Y-m-d')
            ];
        }

        // Jika tidak ada data RFM, set default view data
        if (count($rfmRaw) === 0) {
            $rfmData = [];
        } else {
            // 5. RFM Quintile Scoring (1-5)
            $rfmData = $this->assignQuintiles($rfmRaw);
        }

        // 6. Segmentasi Pelanggan
        $segmentCounts = [
            'Customer Baru' => 0,
            'Loyal' => 0,
            'Berisiko' => 0,
            'Pasif / Lama' => 0,
            'Lainnya' => 0
        ];

        $totalScore = 0;
        $totalRevenue = 0;

        foreach ($rfmData as &$customer) {
            $r = $customer['r_score'];
            $f = $customer['f_score'];
            $m = $customer['m_score'];
            $totalScore += ($r + $f + $m);
            $totalRevenue += $customer['monetary'];

            // Logika Segmentasi:
            if ($r >= 4 && $f <= 2) {
                $segment = 'Customer Baru';
            } elseif ($r >= 4 && $f >= 3 && $m >= 3) {
                $segment = 'Loyal';
            } elseif ($r <= 2 && $f >= 3) {
                $segment = 'Berisiko';
            } elseif ($r <= 2 && $f <= 2) {
                $segment = 'Pasif / Lama';
            } else {
                $segment = 'Lainnya';
            }

            $customer['segment'] = $segment;
            $segmentCounts[$segment]++;
        }

        // Sort descending by Total Score
        usort($rfmData, function($a, $b) {
            $scoreA = $a['r_score'] + $a['f_score'] + $a['m_score'];
            $scoreB = $b['r_score'] + $b['f_score'] + $b['m_score'];
            return $scoreB <=> $scoreA;
        });

        $totalCustomers = count($rfmData);
        $avgScore = $totalCustomers > 0 ? round($totalScore / $totalCustomers, 1) : 0;

        // OLD STATS COMBINED
        $stats = [
            'mitra' => \App\Models\Mitra::count(),
            'program' => \App\Models\ProgramKursus::count(),
            'portofolio' => \App\Models\Portofolio::count(),
            'artikel' => \App\Models\Artikel::count(),
            'orders_count' => \App\Models\Order::count(),
            'orders_paid' => \App\Models\Order::whereIn('status', ['paid', 'PAID', 'SETTLED', 'success'])->count(),
            'orders_revenue' => \App\Models\Order::whereIn('status', ['paid', 'PAID', 'SETTLED', 'success'])->sum('amount'),
            'visitors' => \App\Models\Visitor::count(),
            'layanan' => \App\Models\Layanan::count(),
            'event' => \App\Models\Event::count(),
        ];

        // Fetch Real Visitor Data for the last 7 days
        $visitorLabels = [];
        $visitorData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $visitorLabels[] = $date->locale('id')->translatedFormat('l'); // e.g. "Senin"
            $visitorData[] = \App\Models\Visitor::where('visited_date', $date->toDateString())->count();
        }

        $activities = \App\Models\ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', [
            'rfmData' => $rfmData,
            'segmentCounts' => $segmentCounts,
            'totalCustomers' => $totalCustomers,
            'totalRevenue' => $totalRevenue,
            'avgScore' => $avgScore,
            'stats' => $stats,
            'visitorLabels' => $visitorLabels,
            'visitorData' => $visitorData,
            'activities' => $activities,
        ]);
    }

    private function assignQuintiles($data)
    {
        $count = count($data);
        if ($count == 0) return $data;

        // Recency (Lower days = Higher score 5)
        usort($data, fn($a, $b) => $a['recency_days'] <=> $b['recency_days']);
        foreach ($data as $index => &$item) {
            // Percentile rank (0 to 1)
            $p = $index / $count;
            // Lower recency days is better, so 0 index gets 5
            $item['r_score'] = $this->getQuintileScore(1 - $p); 
        }

        // Frequency (Higher freq = Higher score 5)
        usort($data, fn($a, $b) => $a['frequency'] <=> $b['frequency']);
        foreach ($data as $index => &$item) {
            $p = $index / $count;
            $item['f_score'] = $this->getQuintileScore($p); 
        }

        // Monetary (Higher money = Higher score 5)
        usort($data, fn($a, $b) => $a['monetary'] <=> $b['monetary']);
        foreach ($data as $index => &$item) {
            $p = $index / $count;
            $item['m_score'] = $this->getQuintileScore($p); 
        }

        return $data;
    }

    private function getQuintileScore($percentile)
    {
        if ($percentile >= 0.8) return 5;
        if ($percentile >= 0.6) return 4;
        if ($percentile >= 0.4) return 3;
        if ($percentile >= 0.2) return 2;
        return 1;
    }
}
