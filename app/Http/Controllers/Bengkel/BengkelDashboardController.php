<?php

namespace App\Http\Controllers\Bengkel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BengkelDashboardController extends Controller
{
    /**
     * Tampilkan dashboard bengkel L-Garage dengan fitur operasional lengkap.
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil data work orders secara permanen (bertahan saat logout)
        $workOrders = $this->getWorkOrders();

        // Hitung metrik operasional secara dinamis
        $bookingHariIni = count($workOrders);
        $sedangDiservis = 0;
        $siapAmbil = 0;
        $servisSelesai = 0;
        $totalPendapatan = 0;
        $totalInvoice = 0;
        $pitInUse = [];

        foreach ($workOrders as $wo) {
            $status = $wo['status'] ?? 'Menunggu';
            if (in_array($status, ['Pemeriksaan', 'Pengerjaan'])) {
                $sedangDiservis++;
                if (!empty($wo['pit_bay'])) {
                    $pitInUse[$wo['pit_bay']] = $wo;
                }
            } elseif ($status === 'Siap Diambil') {
                $siapAmbil++;
            } elseif ($status === 'Selesai') {
                $servisSelesai++;
                $totalPendapatan += ($wo['estimasi_biaya'] ?? 0);
                $totalInvoice++;
            }
        }

        $pitAktif = min(count($pitInUse), 4);
        $pitPersen = round(($pitAktif / 4) * 100) . '%';

        $stats = [
            'booking_hari_ini' => $bookingHariIni,
            'sedang_diservis'  => $sedangDiservis,
            'siap_ambil'       => $siapAmbil,
            'servis_selesai'   => $servisSelesai,
            'pendapatan_hari'  => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
            'total_invoice'    => $totalInvoice,
            'pit_aktif'        => $pitAktif,
            'pit_total'        => 4,
            'pit_persen'       => $pitPersen,
        ];

        // Pipeline tahapan pengerjaan servis
        $countMenunggu    = count(array_filter($workOrders, fn($w) => ($w['status'] ?? '') === 'Menunggu'));
        $countPemeriksaan = count(array_filter($workOrders, fn($w) => ($w['status'] ?? '') === 'Pemeriksaan'));
        $countPengerjaan  = count(array_filter($workOrders, fn($w) => ($w['status'] ?? '') === 'Pengerjaan'));
        $countSelesai     = count(array_filter($workOrders, fn($w) => in_array($w['status'] ?? '', ['Siap Diambil', 'Selesai'])));

        $pipeline = [
            ['label' => 'Menunggu',    'count' => $countMenunggu,    'color' => 'amber'],
            ['label' => 'Pemeriksaan', 'count' => $countPemeriksaan, 'color' => 'blue'],
            ['label' => 'Pengerjaan',  'count' => $countPengerjaan,  'color' => 'orange'],
            ['label' => 'Selesai',     'count' => $countSelesai,     'color' => 'green'],
        ];

        // Status 4 PIT Bay detail
        $pitBays = [
            [
                'no' => 1,
                'name' => 'PIT 1 (Lift Hidrolik)',
                'desc' => 'Servis Berat & Kaki-kaki',
                'assigned' => $this->findPitAssignment($workOrders, 'PIT 1')
            ],
            [
                'no' => 2,
                'name' => 'PIT 2 (Tune Up & Oli)',
                'desc' => 'Perawatan Rutin Cepat',
                'assigned' => $this->findPitAssignment($workOrders, 'PIT 2')
            ],
            [
                'no' => 3,
                'name' => 'PIT 3 (Spooring & Balancing)',
                'desc' => 'Roda & Kemudi',
                'assigned' => $this->findPitAssignment($workOrders, 'PIT 3')
            ],
            [
                'no' => 4,
                'name' => 'PIT 4 (Diagnostik & Kelistrikan)',
                'desc' => 'Scanner ECU & Wiring',
                'assigned' => $this->findPitAssignment($workOrders, 'PIT 4')
            ],
        ];

        // Tren pendapatan mingguan (kosong bila belum ada work order)
        $weeklyRevenue = [
            'labels'  => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'data'    => count($workOrders) > 0 ? [3450000, 4200000, 2800000, 5100000, 3900000, $totalPendapatan, 0] : [0, 0, 0, 0, 0, 0, 0],
            'total'   => count($workOrders) > 0 ? 'Rp ' . number_format(19450000 + $totalPendapatan, 0, ',', '.') : 'Rp 0',
            'percent' => count($workOrders) > 0 ? '+18.4%' : '0%',
        ];

        return view('bengkel.dashboard', compact(
            'user', 'stats', 'pipeline', 'workOrders', 'pitBays', 'weeklyRevenue'
        ));
    }

    /**
     * Helper untuk cek assignment di PIT Bay tertentu
     */
    private function findPitAssignment(array $workOrders, string $pitKey): ?array
    {
        foreach ($workOrders as $wo) {
            if (isset($wo['pit_bay']) && str_contains(strtoupper($wo['pit_bay']), $pitKey)) {
                if (in_array($wo['status'] ?? '', ['Pemeriksaan', 'Pengerjaan', 'Menunggu'])) {
                    return $wo;
                }
            }
        }
        return null;
    }

    /**
     * Simpan Work Order / Servis Baru
     */
    public function storeWorkOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:100',
            'customer_phone'   => 'nullable|string|max:30',
            'vehicle_plate'    => 'required|string|max:20',
            'vehicle_model'    => 'required|string|max:100',
            'service_package'  => 'required|string|max:150',
            'estimasi_biaya'   => 'nullable|numeric|min:0',
            'pit_bay'          => 'nullable|string|max:50',
            'mekanik'          => 'nullable|string|max:100',
            'status'           => 'nullable|string|max:50',
            'keluhan'          => 'nullable|string|max:500',
        ]);

        $workOrders = $this->getWorkOrders();

        $newId = 'WO-' . date('ymd') . '-' . str_pad(count($workOrders) + 1, 3, '0', STR_PAD_LEFT);
        $biaya = (float)($validated['estimasi_biaya'] ?? 350000);
        $phone = preg_replace('/[^0-9]/', '', $validated['customer_phone'] ?? '');
        $wa = str_starts_with($phone, '0') ? '62' . substr($phone, 1) : $phone;
        if (empty($wa)) $wa = '6281234567890';

        $status = $validated['status'] ?? 'Menunggu';
        $status = match(strtolower($status)) {
            'tunggu', 'menunggu' => 'Menunggu',
            'pemeriksaan' => 'Pemeriksaan',
            'dikerjakan', 'pengerjaan' => 'Pengerjaan',
            'siap diambil', 'siap' => 'Siap Diambil',
            'selesai' => 'Selesai',
            default => $status
        };

        $progress = match($status) {
            'Menunggu'    => 15,
            'Pemeriksaan' => 35,
            'Pengerjaan'  => 70,
            'Siap Diambil'=> 95,
            'Selesai'     => 100,
            default       => 20
        };

        $newOrder = [
            'id'                  => $newId,
            'antrean_no'          => $request->input('antrean_no', 'A-' . str_pad(count($workOrders) + 1, 3, '0', STR_PAD_LEFT)),
            'customer_name'       => $validated['customer_name'],
            'customer_phone'      => $validated['customer_phone'] ?? '-',
            'customer_wa'         => $wa,
            'vehicle_plate'       => strtoupper(trim($validated['vehicle_plate'])),
            'vehicle_model'       => $validated['vehicle_model'],
            'service_package'     => $validated['service_package'],
            'keluhan'             => $validated['keluhan'] ?? 'Pemeriksaan rutin dan servis berkala',
            'pit_bay'             => !empty($validated['pit_bay']) ? $validated['pit_bay'] : null,
            'mekanik'             => $validated['mekanik'] ?? 'Agus Widodo',
            'status'              => $status,
            'progress'            => $progress,
            'estimasi_biaya'      => $biaya,
            'estimasi_biaya_label'=> 'Rp ' . number_format($biaya, 0, ',', '.'),
            'created_at'          => now()->format('Y-m-d H:i'),
            'created_time'        => now()->format('H:i') . ' WIB',
            'estimasi_selesai'    => 'Hari ini, ' . now()->addHours(2)->format('H:i') . ' WIB',
            'is_paid'             => $status === 'Selesai',
        ];

        // Tambahkan di urutan paling atas
        array_unshift($workOrders, $newOrder);
        $this->saveWorkOrders($workOrders);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Work order #{$newId} untuk {$validated['vehicle_plate']} berhasil didaftarkan!",
                'data' => $newOrder
            ]);
        }

        return redirect()->back()->with('success', "Work order #{$newId} untuk unit {$validated['vehicle_plate']} ({$validated['vehicle_model']}) berhasil didaftarkan!");
    }

    /**
     * Update Status Work Order
     */
    public function updateStatusWorkOrder(Request $request, $id)
    {
        $statusRaw = $request->input('status', 'Pengerjaan');
        $status = match(strtolower($statusRaw)) {
            'tunggu', 'menunggu' => 'Menunggu',
            'pemeriksaan' => 'Pemeriksaan',
            'dikerjakan', 'pengerjaan' => 'Pengerjaan',
            'siap diambil', 'siap' => 'Siap Diambil',
            'selesai' => 'Selesai',
            default => $statusRaw
        };

        $validStatuses = ['Menunggu', 'Pemeriksaan', 'Pengerjaan', 'Siap Diambil', 'Selesai'];

        if (!in_array($status, $validStatuses)) {
            if ($request->wantsJson()) return response()->json(['success' => false, 'message' => 'Status tidak valid.'], 400);
            return redirect()->back()->with('error', 'Status pengerjaan tidak valid.');
        }

        $workOrders = $this->getWorkOrders();
        $found = false;

        foreach ($workOrders as &$wo) {
            if ($wo['id'] === $id || ($wo['antrean_no'] ?? '') === $id || ($wo['vehicle_plate'] ?? '') === $id) {
                $wo['status'] = $status;
                $wo['progress'] = match($status) {
                    'Menunggu'    => 15,
                    'Pemeriksaan' => 40,
                    'Pengerjaan'  => 75,
                    'Siap Diambil'=> 95,
                    'Selesai'     => 100,
                    default       => 50
                };
                if ($status === 'Selesai') {
                    $wo['is_paid'] = true;
                }
                $found = true;
                break;
            }
        }

        if ($found) {
            $this->saveWorkOrders($workOrders);
            $msg = "Status pengerjaan tiket {$id} berhasil diperbarui menjadi {$status}!";
            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $msg]);
            }
            return redirect()->back()->with('success', $msg);
        }

        if ($request->wantsJson()) return response()->json(['success' => false, 'message' => 'Data work order tidak ditemukan.'], 404);
        return redirect()->back()->with('error', 'Data work order tidak ditemukan.');
    }

    /**
     * Hapus Work Order (mendukung AJAX/JSON dan form biasa)
     */
    public function destroyWorkOrder(Request $request, $id)
    {
        $workOrders = $this->getWorkOrders();
        $workOrders = array_values(array_filter($workOrders, function($w) use ($id) {
            return $w['id'] !== $id && ($w['antrean_no'] ?? '') !== $id && ($w['vehicle_plate'] ?? '') !== $id;
        }));
        $this->saveWorkOrders($workOrders);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => "Work order #{$id} berhasil dihapus."]);
        }

        return redirect()->back()->with('success', "Work order #{$id} berhasil dihapus dari sistem.");
    }

    /**
     * Cek Status JSON (untuk Modal Cek Status Cepat)
     */
    public function cekStatusJson(Request $request)
    {
        $query = strtoupper(trim($request->input('plat', '')));
        $workOrders = $this->getWorkOrders();

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Harap masukkan plat nomor atau nomor tiket.'
            ]);
        }

        foreach ($workOrders as $wo) {
            $woPlate = strtoupper(str_replace(' ', '', $wo['vehicle_plate'] ?? ''));
            $cleanQuery = str_replace(' ', '', $query);

            if ($wo['id'] === $query || str_contains($woPlate, $cleanQuery)) {
                return response()->json([
                    'success' => true,
                    'data' => $wo
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => "Kendaraan dengan plat '{$query}' tidak ditemukan dalam antrean servis aktif."
        ]);
    }

    /**
     * Muat Data Demo Lengkap
     */
    public function loadDemoData()
    {
        $this->saveWorkOrders($this->getDefaultDemoWorkOrders());
        return redirect()->back()->with('success', 'Contoh data demo operasional bengkel (4 unit aktif & PIT Bay terisi) berhasil dimuat!');
    }

    /**
     * Kosongkan Data (mendukung GET, POST biasa, dan AJAX/JSON)
     */
    public function resetData(Request $request)
    {
        $this->saveWorkOrders([]);

        // AJAX / JSON request (dari fetch() JavaScript)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Semua data antrean berhasil dikosongkan.']);
        }

        // GET request (via link langsung di browser)
        if ($request->isMethod('get')) {
            return redirect()->route('bengkel.dashboard')->with('info', 'Data bengkel telah dikosongkan. Silakan isi data Anda sendiri.');
        }

        // POST biasa (via form submit)
        return redirect()->back()->with('info', 'Seluruh data work order & antrean bengkel telah dikosongkan (mode clean).');
    }

    /**
     * Default Demo Work Orders
     */
    private function getDefaultDemoWorkOrders(): array
    {
        return [
            [
                'id'                  => 'WO-' . date('ymd') . '-001',
                'customer_name'       => 'Pak Rahmat Hidayat',
                'customer_phone'      => '0812-9843-2210',
                'customer_wa'         => '6281298432210',
                'vehicle_plate'       => 'B 1982 SYZ',
                'vehicle_model'       => 'Toyota Innova Zenix 2.0 V CVT',
                'service_package'     => 'Servis Berkala 40K KM & Ganti Oli TMO 0W-20',
                'keluhan'             => 'Getar setir saat kecepatan 90 km/jam, minta sekalian spooring balancing',
                'pit_bay'             => 'PIT 1 (Lift Hidrolik)',
                'mekanik'             => 'Reza Kurniawan (ASE)',
                'status'              => 'Pengerjaan',
                'progress'            => 65,
                'estimasi_biaya'      => 1250000,
                'estimasi_biaya_label'=> 'Rp 1.250.000',
                'created_at'          => now()->subHours(2)->format('Y-m-d H:i'),
                'created_time'        => '09:15 WIB',
                'estimasi_selesai'    => 'Hari ini, 12:30 WIB',
                'is_paid'             => false,
            ],
            [
                'id'                  => 'WO-' . date('ymd') . '-002',
                'customer_name'       => 'Ibu Cindy Patricia',
                'customer_phone'      => '0878-5521-4320',
                'customer_wa'         => '6287855214320',
                'vehicle_plate'       => 'B 2041 RFS',
                'vehicle_model'       => 'Honda HR-V 1.5 SE CVT',
                'service_package'     => 'Tune Up Injeksi & Scanner OBD-II Diagnostic',
                'keluhan'             => 'Lampu indikator engine menyala kuning tipis saat AC nyala',
                'pit_bay'             => 'PIT 2 (Tune Up & Oli)',
                'mekanik'             => 'Agus Widodo',
                'status'              => 'Pemeriksaan',
                'progress'            => 40,
                'estimasi_biaya'      => 650000,
                'estimasi_biaya_label'=> 'Rp 650.000',
                'created_at'          => now()->subHour()->format('Y-m-d H:i'),
                'created_time'        => '10:00 WIB',
                'estimasi_selesai'    => 'Hari ini, 13:00 WIB',
                'is_paid'             => false,
            ],
            [
                'id'                  => 'WO-' . date('ymd') . '-003',
                'customer_name'       => 'Pak Hendra Setiawan',
                'customer_phone'      => '0811-9234-8819',
                'customer_wa'         => '6281192348819',
                'vehicle_plate'       => 'B 8899 DKR',
                'vehicle_model'       => 'Mitsubishi Pajero Sport Dakar 4x2',
                'service_package'     => 'Overhaul Rem 4 Roda & Kuras Minyak Rem DOT 4',
                'keluhan'             => 'Rem belakang bunyi gesekan saat deselerasi tajam',
                'pit_bay'             => 'PIT 3 (Spooring & Balancing)',
                'mekanik'             => 'Budi Santoso',
                'status'              => 'Siap Diambil',
                'progress'            => 95,
                'estimasi_biaya'      => 980000,
                'estimasi_biaya_label'=> 'Rp 980.000',
                'created_at'          => now()->subHours(3)->format('Y-m-d H:i'),
                'created_time'        => '08:30 WIB',
                'estimasi_selesai'    => 'Siap Serah Terima',
                'is_paid'             => false,
            ],
            [
                'id'                  => 'WO-' . date('ymd') . '-004',
                'customer_name'       => 'dr. Anton Wijaya',
                'customer_phone'      => '0813-2211-9988',
                'customer_wa'         => '6281322119988',
                'vehicle_plate'       => 'D 1450 ACG',
                'vehicle_model'       => 'Hyundai Stargazer Prime IVT',
                'service_package'     => 'Ganti Oli Synthetic 0W-20 & Filter Oli Denso',
                'keluhan'             => 'Servis berkala 10.000 KM pertama',
                'pit_bay'             => 'PIT 4 (Diagnostik & Kelistrikan)',
                'mekanik'             => 'Candra Putra',
                'status'              => 'Selesai',
                'progress'            => 100,
                'estimasi_biaya'      => 750000,
                'estimasi_biaya_label'=> 'Rp 750.000',
                'created_at'          => now()->subHours(4)->format('Y-m-d H:i'),
                'created_time'        => '08:00 WIB',
                'estimasi_selesai'    => 'Selesai & Lunas',
                'is_paid'             => true,
            ]
        ];
    }

    /**
     * Tampilkan halaman Form Reservasi Servis & Kalkulator Estimasi Biaya
     */
    public function booking()
    {
        $user = auth()->user();
        $workOrders = $this->getWorkOrders();

        $customer = null;

        $jasaItems = [
            ['id' => 'jasa_1', 'title' => 'Servis Berkala 60K KM', 'desc' => 'Tuneup, cek rem 4 roda, scanner OBD & kalibrasi sensor mesin', 'price' => 350000, 'checked' => false],
            ['id' => 'jasa_2', 'title' => 'Spooring 3D & Balancing 4 Roda', 'desc' => 'Atasi getar kemudi kecepatan tinggi, kalibrasi sudut roda depan-belakang', 'price' => 200000, 'checked' => false],
            ['id' => 'jasa_3', 'title' => 'Ganti Oli Mesin & Filter', 'desc' => 'Jasa kuras oli mesin, ganti ring baut carter & filter oli', 'price' => 75000, 'checked' => false],
            ['id' => 'jasa_4', 'title' => 'Overhaul Rem 4 Roda & Kuras Minyak Rem', 'desc' => 'Pembersihan tromol, caliper, bleeding minyak rem DOT 4', 'price' => 250000, 'checked' => false]
        ];

        $sparepartItems = [
            ['id' => 'part_1', 'title' => '8L Oli Diesel Mobil 1 Synthetic 5W-30', 'desc' => 'Spesifikasi 2GD-FTV Toyota Innova Reborn', 'stock' => '24 Liter', 'unit_price_label' => '@Rp 140.000 / L', 'price' => 1120000, 'checked' => false],
            ['id' => 'part_2', 'title' => 'Filter Solar & Filter Oli Denso OEM', 'desc' => 'Paket 2 Filter Genuine Parts Toyota', 'stock' => '12 Pcs', 'unit_price_label' => '1 Set Komplit', 'price' => 280000, 'checked' => false],
            ['id' => 'part_3', 'title' => 'Diesel Purge Liqui Moly Injection Cleaner', 'desc' => 'Pembersih nosel injektor mesin common rail diesel', 'stock' => '8 Botol', 'unit_price_label' => '500ml Canister', 'price' => 150000, 'checked' => false],
            ['id' => 'part_4', 'title' => 'Brake Pad / Kampas Rem Depan OEM', 'desc' => 'Bahan semi-metallic tahan panas', 'stock' => '6 Set', 'unit_price_label' => '1 Set Kiri-Kanan', 'price' => 450000, 'checked' => false]
        ];

        $diskonMember = 0;
        $recentBookings = $workOrders;

        $slotInfo = [
            'slot_name' => 'Slot Bengkel',
            'remaining' => max(0, 4 - count($workOrders)),
            'default_date' => date('Y-m-d'),
            'default_session' => '09:00 - 10:30',
            'notes' => ''
        ];

        return view('bengkel.booking', compact(
            'user', 'customer', 'jasaItems', 'sparepartItems', 'diskonMember', 'recentBookings', 'slotInfo'
        ));
    }

    /**
     * Tampilkan halaman Faktur / Digital Invoice L-Garage
     */
    public function invoice(Request $request)
    {
        $user = auth()->user();
        $workOrders = $this->getWorkOrders();

        // Pilih WO pertama atau berdasarkan parameter query ?wo=ID
        $selectedWoId = $request->query('wo');
        $selectedWo = null;

        if ($selectedWoId) {
            foreach ($workOrders as $w) {
                if ($w['id'] === $selectedWoId) {
                    $selectedWo = $w;
                    break;
                }
            }
        }
        if (!$selectedWo && count($workOrders) > 0) {
            $selectedWo = $workOrders[0];
        }

        $custName = $selectedWo['customer_name'] ?? 'Pak Rahmat Hidayat';
        $custPhone = $selectedWo['customer_phone'] ?? '0812-9843-2210';
        $model = $selectedWo['vehicle_model'] ?? 'Toyota Innova Reborn 2.4 Diesel';
        $plate = $selectedWo['vehicle_plate'] ?? 'B 1982 SYZ';
        $biaya = $selectedWo['estimasi_biaya'] ?? 1450000;

        $invoiceData = [
            'doc_no' => '#INV-' . date('Y-m') . '-' . substr($selectedWo['id'] ?? '0482', -4),
            'status' => ($selectedWo['is_paid'] ?? false) ? 'LUNAS / PAID' : 'TERBIT / PROSES',
            'pelunasan_time' => Carbon::now()->translatedFormat('d M Y, H:i') . ' WIB',
            'metode_bayar' => 'QRIS BCA / Transfer Kasir',
            'trx_code' => 'TRX-' . rand(1000000, 9999999),
            'kepala_bengkel' => 'Haryadi S. (Kepala Bengkel)',
            'customer_name' => $custName,
            'customer_phone' => $custPhone,
            'vehicle_model' => $model,
            'vehicle_plate' => $plate,
            'vehicle_odo' => '58.400 KM',
            'vehicle_vin' => 'MHKB1AAJ4NJ' . rand(10000, 99999),
            'jasa_items' => [
                ['title' => $selectedWo['service_package'] ?? 'Servis Berkala & Tune Up', 'desc' => 'General checkup 32 titik sensor', 'price' => 450000]
            ],
            'part_items' => [
                ['title' => 'Oli Mesin Full Synthetic', 'desc' => 'TMO 0W-20 / SAE 5W-30 Original', 'price' => max(0, $biaya - 450000)]
            ],
            'subtotal_jasa' => 450000,
            'subtotal_part' => max(0, $biaya - 450000),
            'ppn_active' => true,
            'ppn_nominal' => round($biaya * 0.11),
            'diskon' => 0,
            'grand_total' => $biaya + round($biaya * 0.11),
            'garansi_bulan' => 1,
            'garansi_km' => '1.000 KM',
            'next_service_date' => Carbon::now()->addMonths(6)->translatedFormat('d F Y'),
            'next_service_km' => '68.400 KM'
        ];

        $presetJasa = [
            ['title' => 'Paket Servis Berkala 40.000 KM', 'desc' => 'Tune up, cek 32 titik keamanan & scan ECU', 'price' => 450000],
            ['title' => 'Penggantian Kampas Rem (Depan & Belakang)', 'desc' => 'Bongkar pasang caliper, bleeding & cleaner', 'price' => 150000],
            ['title' => 'Spooring 3D & Balancing 4 Roda', 'desc' => 'Atasi getar kemudi kecepatan tinggi', 'price' => 200000],
            ['title' => 'Flushing & Kuras Minyak Rem Otomatis', 'desc' => 'Ganti minyak rem DOT 4 mesin vacuum', 'price' => 125000]
        ];

        $presetPart = [
            ['title' => 'Brake Pad Original Toyota Front', 'desc' => 'Part No: 04465-0K360 • 1 Set', 'price' => 680000],
            ['title' => 'Minyak Rem DOT 4 Prestone', 'desc' => 'High Boiling Point Formula • 2 Botol (300ml)', 'price' => 110000],
            ['title' => 'Oli Mesin Full Synthetic 5W-40', 'desc' => 'Toyota Motor Oil (TMO) Diesel Low Ash • 7 Liter', 'price' => 1050000],
            ['title' => 'Oil Filter & Gasket Plug Washer', 'desc' => 'Genuine OEM Filtration Set • 1 Unit', 'price' => 85000]
        ];

        return view('bengkel.invoice', compact('user', 'invoiceData', 'presetJasa', 'presetPart', 'workOrders', 'selectedWo'));
    }

    /**
     * Tampilkan halaman Data Pelanggan & CRM L-Garage
     */
    public function pelanggan()
    {
        $user = auth()->user();
        $workOrders = $this->getWorkOrders();

        $stats = [
            'total_pelanggan' => count($workOrders),
            'pelanggan_baru' => '+' . count($workOrders) . ' bulan ini',
            'pelanggan_aktif' => count($workOrders),
            'siap_servis_unit' => count($workOrders),
            'tingkat_retensi' => count($workOrders) > 0 ? '94.2%' : '0%',
        ];

        // Pelanggan dinamis dari work orders
        $customers = [];
        foreach ($workOrders as $wo) {
            $customers[] = [
                'id' => $wo['id'],
                'name' => $wo['customer_name'],
                'avatar' => strtoupper(substr($wo['customer_name'], 0, 2)),
                'phone' => $wo['customer_phone'],
                'tier' => 'Member Aktif',
                'vehicles' => [
                    [
                        'model' => $wo['vehicle_model'],
                        'plate' => $wo['vehicle_plate'],
                        'odometer' => 'Aktif',
                        'status' => $wo['status'],
                        'status_color' => $wo['status'] === 'Selesai' ? 'emerald' : 'blue'
                    ]
                ],
                'last_service' => 'Hari Ini (' . ($wo['created_time'] ?? '') . ')',
                'last_service_detail' => $wo['service_package'] . ' - ' . $wo['estimasi_biaya_label'],
                'next_service' => 'Jadwal Rutin Berikutnya (~3 Bulan)',
                'alert' => null
            ];
        }

        $demoCustomers = [
            [
                'id' => 1,
                'name' => 'Pak Rahmat Hidayat',
                'avatar' => 'RH',
                'phone' => '0812-9843-2210',
                'tier' => 'Diamond',
                'vehicles' => [
                    [
                        'model' => 'Toyota Innova Reborn 2.4 Diesel',
                        'plate' => 'B 2314 TZZ',
                        'odometer' => '58.400 KM',
                        'status' => 'Sehat',
                        'status_color' => 'emerald'
                    ]
                ],
                'last_service' => '24 Okt 2024',
                'last_service_detail' => 'Ganti Oli Full Synthetic & Tune Up - Rp 2.000.000 (Lunas)',
                'next_service' => '24 Jan 2025 (~65.000 KM)',
                'alert' => null
            ],
            [
                'id' => 2,
                'name' => 'Pak Hendra Setiawan',
                'avatar' => 'HS',
                'phone' => '0811-9234-8819',
                'tier' => 'Gold Member',
                'vehicles' => [
                    [
                        'model' => 'Mitsubishi Pajero Sport Dakar 4x2',
                        'plate' => 'B 8899 DKR',
                        'odometer' => '41.200 KM',
                        'status' => 'Due Service',
                        'status_color' => 'amber'
                    ]
                ],
                'last_service' => '12 Mei 2024',
                'last_service_detail' => 'Servis Berkala 30.000 KM & Spooring Balancing',
                'next_service' => 'Jatuh Tempo Terlewat',
                'alert' => [
                    'type' => 'warning',
                    'title' => 'Waktunya Ganti Oli & Pengecekan Rem',
                    'desc' => 'Jatuh tempo terlewat 12 hari atau estimasi +1.200 KM dari jadwal ideal.'
                ]
            ]
        ];

        return view('bengkel.pelanggan', compact('user', 'stats', 'customers', 'demoCustomers'));
    }

    /**
     * Tampilkan halaman Work Order & Manajemen Servis
     */
    public function servis()
    {
        $user = auth()->user();
        $workOrders = $this->getWorkOrders();

        $pitBays = [
            ['no' => '01', 'status' => $this->findPitAssignment($workOrders, 'PIT 1') ? 'Terisi' : 'Kosong', 'color' => $this->findPitAssignment($workOrders, 'PIT 1') ? 'amber' : 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '02', 'status' => $this->findPitAssignment($workOrders, 'PIT 2') ? 'Terisi' : 'Kosong', 'color' => $this->findPitAssignment($workOrders, 'PIT 2') ? 'amber' : 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '03', 'status' => $this->findPitAssignment($workOrders, 'PIT 3') ? 'Terisi' : 'Kosong', 'color' => $this->findPitAssignment($workOrders, 'PIT 3') ? 'amber' : 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '04', 'status' => $this->findPitAssignment($workOrders, 'PIT 4') ? 'Terisi' : 'Kosong', 'color' => $this->findPitAssignment($workOrders, 'PIT 4') ? 'amber' : 'emerald', 'icon' => 'fa-circle-check'],
        ];

        $mekaniks = [
            ['name' => 'Agus Widodo',     'initial' => 'AW', 'level' => 'Senior', 'color' => 'blue'],
            ['name' => 'Budi Santoso',    'initial' => 'BS', 'level' => 'Senior', 'color' => 'indigo'],
            ['name' => 'Candra Putra',    'initial' => 'CP', 'level' => 'Junior', 'color' => 'teal'],
            ['name' => 'Deni Firmansyah', 'initial' => 'DF', 'level' => 'Junior', 'color' => 'purple'],
        ];

        return view('bengkel.servis', compact('user', 'pitBays', 'mekaniks', 'workOrders'));
    }

    /**
     * Tampilkan halaman Antrean PIT Bay & Monitor Servis Live
     */
    public function antrean()
    {
        $user = auth()->user();
        $workOrders = $this->getWorkOrders();

        $pitBays = [
            ['no' => '01', 'status' => $this->findPitAssignment($workOrders, 'PIT 1') ? 'terisi' : 'kosong'],
            ['no' => '02', 'status' => $this->findPitAssignment($workOrders, 'PIT 2') ? 'terisi' : 'kosong'],
            ['no' => '03', 'status' => $this->findPitAssignment($workOrders, 'PIT 3') ? 'terisi' : 'kosong'],
            ['no' => '04', 'status' => $this->findPitAssignment($workOrders, 'PIT 4') ? 'terisi' : 'kosong'],
        ];

        $mekaniks = [
            ['name' => 'Agus Widodo',     'initial' => 'AW', 'level' => 'Senior', 'color' => 'blue'],
            ['name' => 'Budi Santoso',    'initial' => 'BS', 'level' => 'Senior', 'color' => 'indigo'],
            ['name' => 'Candra Putra',    'initial' => 'CP', 'level' => 'Junior', 'color' => 'teal'],
            ['name' => 'Deni Firmansyah', 'initial' => 'DF', 'level' => 'Junior', 'color' => 'purple'],
        ];

        $antreanList = $workOrders;

        return view('bengkel.antrean', compact('user', 'pitBays', 'mekaniks', 'antreanList'));
    }

    /**
     * Ambil data Work Orders dari persistent file storage (data tidak hilang saat keluar / logout)
     */
    private function getWorkOrders(): array
    {
        $path = storage_path('app/bengkel_work_orders.json');
        if (file_exists($path)) {
            $content = @file_get_contents($path);
            $data = json_decode($content, true);
            if (is_array($data)) {
                return $data;
            }
        }

        // Fallback migrasi jika ada data di session yang belum disimpan ke file
        $sessionData = session('bengkel_work_orders', null);
        if (is_array($sessionData) && count($sessionData) > 0) {
            $this->saveWorkOrders($sessionData);
            return $sessionData;
        }

        return [];
    }

    /**
     * Simpan data Work Orders secara permanen ke disk storage & session
     */
    private function saveWorkOrders(array $workOrders): void
    {
        $path = storage_path('app/bengkel_work_orders.json');
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        @file_put_contents($path, json_encode(array_values($workOrders), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // Sinkronkan ke session aktif
        session(['bengkel_work_orders' => $workOrders]);
    }
}
