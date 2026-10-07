<?php

namespace App\Http\Controllers\Bengkel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BengkelDashboardController extends Controller
{
    /**
     * Tampilkan dashboard bengkel L-Garage dengan data kosong (siap diisi).
     */
    public function index()
    {
        $user = auth()->user();

        // Statistik kosong — akan diisi dari database bengkel nantinya
        $stats = [
            'booking_hari_ini' => 0,
            'sedang_diservis'  => 0,
            'siap_ambil'       => 0,
            'servis_selesai'   => 0,
            'pendapatan_hari'  => 'Rp 0',
            'total_invoice'    => 0,
            'pit_aktif'        => 0,
            'pit_total'        => 4,
            'pit_persen'       => '0%',
        ];

        // Pipeline pengerjaan kosong
        $pipeline = [
            ['label' => 'Menunggu', 'count' => 0, 'color' => 'amber'],
            ['label' => 'Pemeriksaan', 'count' => 0, 'color' => 'blue'],
            ['label' => 'Pengerjaan', 'count' => 0, 'color' => 'orange'],
            ['label' => 'Selesai', 'count' => 0, 'color' => 'green'],
        ];

        // WO (Work Order) aktif — data kosong
        $workOrders = [];

        // Tren pendapatan mingguan (kosong)
        $weeklyRevenue = [
            'labels'  => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'data'    => [0, 0, 0, 0, 0, 0, 0],
            'total'   => 'Rp 0',
            'percent' => '0%',
        ];

        return view('bengkel.dashboard', compact(
            'user', 'stats', 'pipeline', 'workOrders', 'weeklyRevenue'
        ));
    }

    /**
     * Tampilkan halaman Form Reservasi Servis & Kalkulator Estimasi Biaya (Desktop Website) dengan data kosong siap diisi.
     */
    public function booking()
    {
        $user = auth()->user();

        // Data pelanggan & kendaraan kosong — siap diinput user
        $customer = null;

        // Katalog opsi jasa (semua unchecked / default belum dipilih)
        $jasaItems = [
            [
                'id' => 'jasa_1',
                'title' => 'Servis Berkala 60K KM',
                'desc' => 'Tuneup, cek rem 4 roda, scanner OBD & kalibrasi sensor mesin',
                'price' => 350000,
                'checked' => false
            ],
            [
                'id' => 'jasa_2',
                'title' => 'Spooring 3D & Balancing 4 Roda',
                'desc' => 'Atasi getar kemudi kecepatan tinggi, kalibrasi sudut roda depan-belakang',
                'price' => 200000,
                'checked' => false
            ],
            [
                'id' => 'jasa_3',
                'title' => 'Ganti Oli Mesin & Filter',
                'desc' => 'Jasa kuras oli mesin, ganti ring baut carter & filter oli',
                'price' => 75000,
                'checked' => false
            ],
            [
                'id' => 'jasa_4',
                'title' => 'Overhaul Rem 4 Roda & Kuras Minyak Rem',
                'desc' => 'Pembersihan tromol, caliper, bleeding minyak rem DOT 4',
                'price' => 250000,
                'checked' => false
            ]
        ];

        // Katalog opsi sparepart (semua unchecked / default belum dipilih)
        $sparepartItems = [
            [
                'id' => 'part_1',
                'title' => '8L Oli Diesel Mobil 1 Synthetic 5W-30',
                'desc' => 'Spesifikasi 2GD-FTV Toyota Innova Reborn',
                'stock' => '24 Liter',
                'unit_price_label' => '@Rp 140.000 / L',
                'price' => 1120000,
                'checked' => false
            ],
            [
                'id' => 'part_2',
                'title' => 'Filter Solar & Filter Oli Denso OEM',
                'desc' => 'Paket 2 Filter Genuine Parts Toyota',
                'stock' => '12 Pcs',
                'unit_price_label' => '1 Set Komplit',
                'price' => 280000,
                'checked' => false
            ],
            [
                'id' => 'part_3',
                'title' => 'Diesel Purge Liqui Moly Injection Cleaner',
                'desc' => 'Pembersih nosel injektor mesin common rail diesel',
                'stock' => '8 Botol',
                'unit_price_label' => '500ml Canister',
                'price' => 150000,
                'checked' => false
            ],
            [
                'id' => 'part_4',
                'title' => 'Brake Pad / Kampas Rem Depan OEM',
                'desc' => 'Bahan semi-metallic tahan panas',
                'stock' => '6 Set',
                'unit_price_label' => '1 Set Kiri-Kanan',
                'price' => 450000,
                'checked' => false
            ]
        ];

        $diskonMember = 0;

        // Data booking masuk kosong
        $recentBookings = [];

        $slotInfo = [
            'slot_name' => 'Slot BSD',
            'remaining' => 4,
            'default_date' => date('Y-m-d'),
            'default_session' => '09:00 - 10:30',
            'notes' => ''
        ];

        return view('bengkel.booking', compact(
            'user', 'customer', 'jasaItems', 'sparepartItems', 'diskonMember', 'recentBookings', 'slotInfo'
        ));
    }

    /**
     * Tampilkan halaman Faktur / Digital Invoice L-Garage (Desktop Website) dengan data kosong siap diisi.
     */
    public function invoice()
    {
        $user = auth()->user();

        $invoiceData = [
            'doc_no' => '#INV-' . date('Y-m') . '-0482',
            'status' => 'LUNAS / PAID',
            'pelunasan_time' => \Carbon\Carbon::now()->translatedFormat('d M Y, H:i') . ' WIB',
            'metode_bayar' => 'QRIS BCA / Transfer',
            'trx_code' => 'TRX-' . rand(1000000, 9999999),
            'kepala_bengkel' => 'Haryadi S.',
            'customer_name' => '',
            'customer_phone' => '',
            'vehicle_model' => '',
            'vehicle_plate' => '',
            'vehicle_odo' => '',
            'vehicle_vin' => '',
            'jasa_items' => [],
            'part_items' => [],
            'subtotal_jasa' => 0,
            'subtotal_part' => 0,
            'ppn_active' => true,
            'ppn_nominal' => 0,
            'diskon' => 0,
            'grand_total' => 0,
            'garansi_bulan' => 1,
            'garansi_km' => '1.000 KM',
            'next_service_date' => \Carbon\Carbon::now()->addMonths(6)->translatedFormat('d F Y'),
            'next_service_km' => ''
        ];

        // Katalog template cepat jika ingin dipilih user
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

        return view('bengkel.invoice', compact('user', 'invoiceData', 'presetJasa', 'presetPart'));
    }

    /**
     * Tampilkan halaman Data Pelanggan & CRM L-Garage (Desktop Website) dengan data kosong siap diisi.
     */
    public function pelanggan()
    {
        $user = auth()->user();

        // Statistik pelanggan awal (kosong)
        $stats = [
            'total_pelanggan' => 0,
            'pelanggan_baru' => '+0 bulan ini',
            'pelanggan_aktif' => 0,
            'siap_servis_unit' => 0,
            'tingkat_retensi' => '0%',
        ];

        // Daftar pelanggan kosong (sesuai request pengguna)
        $customers = [];

        // Data demo preset jika pengguna ingin meninjau contoh tampilan seperti di gambar
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
                    ],
                    [
                        'model' => 'Honda HR-V 1.5 SE',
                        'plate' => 'B 1024 PUZ',
                        'odometer' => '74.100 KM',
                        'status' => 'Standby',
                        'status_color' => 'slate'
                    ]
                ],
                'last_service' => '24 Okt 2024 (Kemarin)',
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
            ],
            [
                'id' => 3,
                'name' => 'Ibu Cindy Patricia',
                'avatar' => 'CP',
                'phone' => '0878-5521-4320',
                'tier' => 'Silver Member',
                'vehicles' => [
                    [
                        'model' => 'Honda CR-V 1.5L Turbo',
                        'plate' => 'B 2041 RFS',
                        'odometer' => '32.150 KM',
                        'status' => 'Estimasi: 15:30 WIB',
                        'status_color' => 'blue'
                    ]
                ],
                'last_service' => 'Sedang Dikerjakan di Pit 03',
                'last_service_detail' => 'Work Order #LG-8942 • Mekanik Agus W.',
                'next_service' => 'Dalam Pengerjaan (65%)',
                'alert' => [
                    'type' => 'progress',
                    'title' => 'Sedang Dikerjakan di Pit 03',
                    'desc' => 'Work Order #LG-8942 • Mekanik Agus W. (65% Progress)'
                ]
            ]
        ];

        return view('bengkel.pelanggan', compact('user', 'stats', 'customers', 'demoCustomers'));
    }

    /**
     * Tampilkan halaman Work Order & Manajemen Servis L-Garage (Desktop Website) dengan data kosong siap diisi.
     */
    public function servis()
    {
        $user = auth()->user();

        // PIT Bay status — awalnya semua kosong
        $pitBays = [
            ['no' => '01', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '02', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '03', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
            ['no' => '04', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
        ];

        // Data mekanik aktif
        $mekaniks = [
            ['name' => 'Agus Widodo',     'initial' => 'AW', 'level' => 'Senior', 'color' => 'blue'],
            ['name' => 'Budi Santoso',    'initial' => 'BS', 'level' => 'Senior', 'color' => 'indigo'],
            ['name' => 'Candra Putra',    'initial' => 'CP', 'level' => 'Junior', 'color' => 'teal'],
            ['name' => 'Deni Firmansyah', 'initial' => 'DF', 'level' => 'Junior', 'color' => 'purple'],
        ];

        // Work Order kosong — board siap diisi
        $workOrders = [];

        return view('bengkel.servis', compact('user', 'pitBays', 'mekaniks', 'workOrders'));
    }

    /**
     * Tampilkan halaman Antrean PIT Bay & Monitor Servis Live L-Garage (Desktop Website) dengan data kosong.
     */
    public function antrean()
    {
        $user = auth()->user();

        // PIT Bay — semua kosong saat awal
        $pitBays = [
            ['no' => '01', 'status' => 'kosong'],
            ['no' => '02', 'status' => 'kosong'],
            ['no' => '03', 'status' => 'kosong'],
            ['no' => '04', 'status' => 'kosong'],
        ];

        // Mekanik aktif
        $mekaniks = [
            ['name' => 'Agus Widodo',     'initial' => 'AW', 'level' => 'Senior', 'color' => 'blue'],
            ['name' => 'Budi Santoso',    'initial' => 'BS', 'level' => 'Senior', 'color' => 'indigo'],
            ['name' => 'Candra Putra',    'initial' => 'CP', 'level' => 'Junior', 'color' => 'teal'],
            ['name' => 'Deni Firmansyah', 'initial' => 'DF', 'level' => 'Junior', 'color' => 'purple'],
        ];

        // Data antrean kosong
        $antreanList = [];

        return view('bengkel.antrean', compact('user', 'pitBays', 'mekaniks', 'antreanList'));
    }
}



