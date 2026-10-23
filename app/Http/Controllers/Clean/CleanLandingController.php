<?php

namespace App\Http\Controllers\Clean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\LaundryOrder;
use App\Models\LaundryService;
use App\Models\LaundryCustomer;
use Carbon\Carbon;

class CleanLandingController extends Controller
{
    /**
     * Tampilkan Portal Publik / Website Pengunjung L-Clean.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $tab = $request->query('tab', 'beranda'); // beranda | layanan | status | pesan
        $searchCode = strtoupper(trim($request->query('kode', 'LC-89304')));

        // 1. DAFTAR LAYANAN L-CLEAN LENGKAP
        $services = [
            [
                'id' => 'kiloan-reguler',
                'category' => 'kiloan',
                'name' => 'Kiloan Reguler',
                'badge' => 'Standar',
                'badge_color' => 'blue',
                'estimate' => 'Estimasi 2 Hari (48 Jam)',
                'price_per_unit' => 8000,
                'price_formatted' => 'Rp 8.000',
                'unit' => '/ kg',
                'min_order' => 'Min. 3 kg',
                'image' => '/images/clean/kiloan.jpg',
                'features' => [
                    'Cuci basah & pengeringan higienis 100%',
                    'Setrika uap presisi antibakteri',
                    'Kemasan plastik segel kedap udara rapi',
                ],
                'popular' => false,
            ],
            [
                'id' => 'kiloan-kilat',
                'category' => 'kiloan',
                'name' => 'Kiloan Kilat / Express',
                'badge' => 'Populer',
                'badge_color' => 'amber',
                'estimate' => 'Selesai 6–8 Jam (Hari Sama)',
                'price_per_unit' => 14000,
                'price_formatted' => 'Rp 14.000',
                'unit' => '/ kg',
                'min_order' => 'Min. 3 kg',
                'image' => '/images/clean/kiloan.jpg',
                'features' => [
                    'Prioritas antrean mesin utama (1 mesin 1 pelanggan)',
                    'Pengeringan turbo anti bau apek / lembap',
                    'Antar jemput di hari yang sama',
                ],
                'popular' => true,
            ],
            [
                'id' => 'super-express',
                'category' => 'kiloan',
                'name' => 'Super Express 3 Jam',
                'badge' => '3 Jam Jadi',
                'badge_color' => 'rose',
                'estimate' => '3 Jam Selesai Kilat',
                'price_per_unit' => 20000,
                'price_formatted' => 'Rp 20.000',
                'unit' => '/ kg',
                'min_order' => 'Min. 3 kg',
                'image' => '/images/clean/kiloan.jpg',
                'features' => [
                    'Penanganan ultra cepat darurat meeting / bepergian',
                    'Mesin dedicated 1 tabung non-stop',
                    'Finishing uap tekanan tinggi & pewangi luxury',
                ],
                'popular' => false,
            ],
            [
                'id' => 'dry-clean-jas',
                'category' => 'dryclean',
                'name' => 'Jas / Blazer Pria & Wanita',
                'badge' => 'Dry Clean',
                'badge_color' => 'indigo',
                'estimate' => 'Estimasi 2–3 Hari',
                'price_per_unit' => 35000,
                'price_formatted' => 'Rp 35.000',
                'unit' => '/ pcs',
                'min_order' => '1 Pcs',
                'image' => '/images/clean/dryclean.jpg',
                'features' => [
                    'Dry clean profesional menjaga serat wol & lining',
                    'Solvent Eco-Soft ramah lingkungan tanpa racun karsinogen',
                    'Termasuk wooden hanger & premium garment bag',
                ],
                'popular' => false,
            ],
            [
                'id' => 'gaun-kebaya',
                'category' => 'dryclean',
                'name' => 'Gaun Pesta / Kebaya Brokat',
                'badge' => 'Bahan Sensitif',
                'badge_color' => 'purple',
                'estimate' => 'Estimasi 3–4 Hari',
                'price_per_unit' => 45000,
                'price_formatted' => 'Rp 45.000',
                'unit' => '/ pcs',
                'min_order' => '1 Pcs',
                'image' => '/images/clean/dryclean.jpg',
                'features' => [
                    'Perawatan khusus payet, sutra, organza, dan tile halus',
                    'Handwash lembut & steam vertikal steril',
                    'Inspeksi detail payet lepas & pelindung resleting',
                ],
                'popular' => false,
            ],
            [
                'id' => 'sepatu-sneakers',
                'category' => 'sepatu',
                'name' => 'Deep Clean Sepatu & Bag Care',
                'badge' => 'Care Khusus',
                'badge_color' => 'teal',
                'estimate' => 'Estimasi 2 Hari',
                'price_per_unit' => 40000,
                'price_formatted' => 'Rp 40.000',
                'unit' => '/ pasang',
                'min_order' => '1 Pasang',
                'image' => '/images/clean/shoes.jpg',
                'features' => [
                    'Sneakers, kanvas, leather, & suede treatment',
                    'Unyellowing sole & anti-microbial sanitation',
                    'Deodorizer khusus aroma segar tahan lama',
                ],
                'popular' => false,
            ],
            [
                'id' => 'bedcover-king',
                'category' => 'bedding',
                'name' => 'Bedcover King Size & Karpet',
                'badge' => 'Bedding Care',
                'badge_color' => 'emerald',
                'estimate' => 'Estimasi 2 Hari',
                'price_per_unit' => 35000,
                'price_formatted' => 'Rp 35.000',
                'unit' => '/ pcs',
                'min_order' => '1 Pcs',
                'image' => '/images/clean/bedcover.jpg',
                'features' => [
                    'Ekstraksi debu tungau & bulu hewan peliharaan',
                    'Drum mesin industri ekstra besar (bebas kusut)',
                    'Sanitasi suhu optimal 60°C anti kuman kasur',
                ],
                'popular' => false,
            ],
        ];

        // 2. DATA PELACAKAN REAL-TIME (Untuk Order yang Dicari)
        $trackingResult = $this->buildTrackingData($searchCode);

        // 3. RIWAYAT ORDER USER JIKA LOGGED IN
        $userOrders = [];
        if ($user) {
            $userOrders = LaundryOrder::where('whatsapp_phone', $user->phone ?? '')
                ->orWhere('client_name', 'LIKE', '%' . $user->name . '%')
                ->latest()
                ->take(5)
                ->get();
        }

        return Inertia::render('Clean/Landing', [
            'auth' => [
                'user' => $user,
                'isCleanAdmin' => $user ? $user->isCleanUser() : false,
            ],
            'activeTab' => $tab,
            'services' => $services,
            'trackingResult' => $trackingResult,
            'searchCode' => $searchCode,
            'userOrders' => $userOrders,
        ]);
    }

    /**
     * Endpoint Form Booking Penjemputan Laundry (Bisa Guest / Member).
     */
    public function storePublicOrder(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'whatsapp' => 'required|string|max:25',
            'alamat' => 'required|string|max:300',
            'patokan' => 'nullable|string|max:150',
            'instruksi_kurir' => 'nullable|string|max:200',
            'service_name' => 'required|string|max:100',
            'jadwal_hari' => 'required|string|max:50',
            'jadwal_jam' => 'required|string|max:50',
            'fragrance' => 'required|string|max:50',
            'is_hypoallergenic' => 'boolean',
            'catatan' => 'nullable|string|max:500',
            'payment_method' => 'required|string|max:50',
            'estimated_amount' => 'required|numeric',
            'weight_est' => 'nullable|string|max:30',
        ]);

        // Generate Order ID Unik (contoh: LC-94812)
        $orderId = 'LC-' . rand(10000, 99999);

        // Siapkan detail catatan
        $fullNotes = "Alamat: {$validated['alamat']}";
        if (!empty($validated['patokan'])) {
            $fullNotes .= " (Patokan: {$validated['patokan']})";
        }
        if (!empty($validated['instruksi_kurir'])) {
            $fullNotes .= " | Catatan Kurir: {$validated['instruksi_kurir']}";
        }
        $fullNotes .= " | Jadwal: {$validated['jadwal_hari']} ({$validated['jadwal_jam']})";
        $fullNotes .= " | Pewangi: {$validated['fragrance']}";
        if (!empty($validated['is_hypoallergenic'])) {
            $fullNotes .= " [Hypoallergenic Ramah Lingkungan Aktif]";
        }
        if (!empty($validated['catatan'])) {
            $fullNotes .= " | Catatan Khusus: {$validated['catatan']}";
        }

        $order = LaundryOrder::create([
            'order_id' => $orderId,
            'tenant_name' => 'L-Clean Hub Kemang #01',
            'rfid_tag' => 'TAG-' . rand(1000, 9999),
            'client_name' => $validated['nama'],
            'client_badge' => auth()->check() ? 'Member Langganan' : 'Public Customer',
            'whatsapp_phone' => $validated['whatsapp'],
            'service_name' => $validated['service_name'],
            'weight_items' => $validated['weight_est'] ?? '5.0 kg (Est)',
            'stage' => 'Diterima',
            'stage_type' => 'sky',
            'est_completion' => 'Hari ini / Besok, 17:00 WIB',
            'completion_sub' => 'Penjemputan Dijadwalkan',
            'specialist' => 'Kurir Dispatch L-Clean',
            'amount' => $validated['estimated_amount'],
            'status' => 'Diterima',
            'payment_status' => $validated['payment_method'] === 'Bayar Kurir (COD)' ? 'UNPAID' : 'PAID',
            'payment_method' => $validated['payment_method'],
            'delivery_type' => 'Courier Delivery (Antar-Jemput)',
            'notes' => $fullNotes,
        ]);

        // Cek jika request minta JSON
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'order_id' => $orderId,
                'message' => 'Pesanan penjemputan berhasil dijadwalkan! Kurir L-Clean segera meluncur.',
                'order' => $order,
            ]);
        }

        return redirect()->route('clean.landing', ['tab' => 'status', 'kode' => $orderId])
            ->with('success', "Pesanan #{$orderId} berhasil dijadwalkan! Kurir L-Clean akan segera menghubungi WhatsApp Anda.");
    }

    /**
     * Helper untuk memetakan tracking data real-time
     */
    private function buildTrackingData($code)
    {
        // Cari di DB jika ada order nyata
        $dbOrder = LaundryOrder::where('order_id', $code)->first();

        if ($dbOrder) {
            $stages = [
                'Diterima' => 2,
                'Proses' => 4,
                'Selesai' => 5,
                'Diambil' => 6,
            ];
            $currentStageIndex = $stages[$dbOrder->stage] ?? 4;

            return [
                'found' => true,
                'order_id' => $dbOrder->order_id,
                'status_label' => $dbOrder->stage === 'Proses' ? 'Sedang Diproses' : ($dbOrder->stage === 'Selesai' ? 'Selesai Dicuci' : $dbOrder->stage),
                'service_badge' => strtoupper($dbOrder->service_name),
                'client_name' => $dbOrder->client_name,
                'outlet_name' => $dbOrder->tenant_name ?: 'L-Clean Cabang Kemang',
                'est_completion' => $dbOrder->est_completion ?: 'Hari Ini, 16:30 WIB',
                'est_remaining' => 'Tersisa ~2 Jam 15 Menit',
                'progress_percentage' => min(100, $currentStageIndex * 16),
                'current_stage_step' => $currentStageIndex,
                'total_steps' => 6,
                'stepper' => [
                    [
                        'step' => 1,
                        'title' => 'Dijemput Kurir',
                        'time' => 'Selesai 09:15',
                        'desc' => 'Driver: Rangga (B 4912 SKT)',
                        'status' => 'completed',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Ditimbang & Disortir',
                        'time' => 'Selesai 10:00',
                        'desc' => 'Berat terkonfirmasi: ' . ($dbOrder->weight_items ?: '5.2 kg'),
                        'status' => 'completed',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Dicuci & Dibilas',
                        'time' => 'Selesai 11:20',
                        'desc' => 'Mesin Industri Drum #04',
                        'status' => 'completed',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Kering & Setrika Uap',
                        'time' => 'Sedang Berlangsung',
                        'desc' => 'Suhu Uap 60°C Anti Bakteri',
                        'status' => $currentStageIndex >= 4 ? ($currentStageIndex === 4 ? 'active' : 'completed') : 'pending',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Kontrol Kualitas',
                        'time' => 'Menunggu Tahap 5',
                        'desc' => 'Segel Higienis Kedap Udara',
                        'status' => $currentStageIndex >= 5 ? ($currentStageIndex === 5 ? 'active' : 'completed') : 'pending',
                    ],
                    [
                        'step' => 6,
                        'title' => 'Pengantaran Balik',
                        'time' => 'Menunggu Tahap 6',
                        'desc' => 'Menuju Alamat Pelanggan',
                        'status' => $currentStageIndex >= 6 ? 'completed' : 'pending',
                    ],
                ],
                'items_breakdown' => [
                    ['name' => 'Kemeja Katun', 'qty' => '4 pcs'],
                    ['name' => 'Celana Jeans', 'qty' => '2 pcs'],
                    ['name' => 'T-Shirt / Kaos', 'qty' => '6 pcs'],
                    ['name' => 'Handuk Katun', 'qty' => '1 pcs'],
                ],
                'total_pcs' => 13,
                'scale_weight' => $dbOrder->weight_items ?: '5.20 kg',
                'scale_photo' => '/images/clean/scale.jpg',
                'scale_time' => 'Pukul 10:02 WIB',
                'fragrance' => 'Ocean Breeze Antibacterial',
                'detergent' => 'Hypoallergenic Ramah Lingkungan',
                'amount_formatted' => 'Rp ' . number_format($dbOrder->amount, 0, ',', '.'),
                'payment_status' => $dbOrder->payment_status ?: 'LUNAS (QRIS)',
                'outlet_address' => 'Jl. Kemang Raya No. 42B, Jaksel (Radius Antar 8.5 km)',
                'outlet_phone' => '6281299087788',
            ];
        }

        // Default Data sesuai Gambar 3 (LC-89304)
        return [
            'found' => true,
            'order_id' => 'LC-89304',
            'status_label' => 'Sedang Diproses',
            'service_badge' => 'CUCI KOMPLIT EXPRESS',
            'client_name' => 'Budi Santoso',
            'outlet_name' => 'L-Clean Cabang Kemang',
            'est_completion' => 'Hari Ini, 16:30 WIB',
            'est_remaining' => 'Tersisa ~2 Jam 15 Menit',
            'progress_percentage' => 65,
            'current_stage_step' => 4,
            'total_steps' => 6,
            'stepper' => [
                [
                    'step' => 1,
                    'title' => 'Dijemput Kurir',
                    'time' => 'Selesai 09:15',
                    'desc' => 'Driver: Rangga (B 4912 SKT)',
                    'status' => 'completed',
                ],
                [
                    'step' => 2,
                    'title' => 'Ditimbang & Disortir',
                    'time' => 'Selesai 10:00',
                    'desc' => 'Berat terkonfirmasi: 5.2 kg',
                    'status' => 'completed',
                ],
                [
                    'step' => 3,
                    'title' => 'Dicuci & Dibilas',
                    'time' => 'Selesai 11:20',
                    'desc' => 'Mesin Industri Drum #04',
                    'status' => 'completed',
                ],
                [
                    'step' => 4,
                    'title' => 'Kering & Setrika Uap',
                    'time' => 'Sedang Berlangsung',
                    'desc' => 'Suhu Uap 60°C Anti Bakteri',
                    'status' => 'active',
                ],
                [
                    'step' => 5,
                    'title' => 'Kontrol Kualitas',
                    'time' => 'Menunggu Tahap 5',
                    'desc' => 'Segel Higienis Kedap Udara',
                    'status' => 'pending',
                ],
                [
                    'step' => 6,
                    'title' => 'Pengantaran Balik',
                    'time' => 'Menunggu Tahap 6',
                    'desc' => 'Menuju Rumah Kemang Timur',
                    'status' => 'pending',
                ],
            ],
            'items_breakdown' => [
                ['name' => 'Kemeja Katun', 'qty' => '4 pcs'],
                ['name' => 'Celana Jeans', 'qty' => '2 pcs'],
                ['name' => 'T-Shirt / Kaos', 'qty' => '6 pcs'],
                ['name' => 'Handuk Katun', 'qty' => '1 pcs'],
            ],
            'total_pcs' => 13,
            'scale_weight' => '5.20 kg',
            'scale_photo' => '/images/clean/scale.jpg',
            'scale_time' => 'Pukul 10:02 WIB',
            'fragrance' => 'Ocean Breeze Antibacterial',
            'detergent' => 'Hypoallergenic Ramah Lingkungan',
            'amount_formatted' => 'Rp 72.800',
            'payment_status' => 'LUNAS (QRIS)',
            'outlet_address' => 'Jl. Kemang Raya No. 42B, Jaksel (Radius Antar 8.5 km)',
            'outlet_phone' => '6281299087788',
        ];
    }
}
