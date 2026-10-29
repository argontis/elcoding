<?php

namespace App\Http\Controllers\Prosal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProsalDashboardController extends Controller
{
    /**
     * Inisialisasi data default session jika belum ada
     */
    protected function initSessionData()
    {
        if (!session()->has('prosal_units')) {
            session([
                'prosal_units' => [
                    [
                        'id' => 'UNT-01',
                        'nama' => 'Apartemen Grand Sudirman Lt. 14 B',
                        'kategori' => 'Apartemen',
                        'lokasi' => 'Tower B, Jakarta Selatan',
                        'tipe' => '2 BR • 54 m²',
                        'harga' => 8500000,
                        'status' => 'Tersewa',
                        'penyewa' => 'Bpk. Hendra Gunawan',
                        'jatuh_tempo' => '15 Nov 2026',
                    ],
                    [
                        'id' => 'UNT-02',
                        'nama' => 'Apartemen Grand Sudirman Lt. 08 A',
                        'kategori' => 'Apartemen',
                        'lokasi' => 'Tower A, Jakarta Selatan',
                        'tipe' => '1 BR • 38 m²',
                        'harga' => 6000000,
                        'status' => 'Tersedia',
                        'penyewa' => '-',
                        'jatuh_tempo' => '-',
                    ],
                    [
                        'id' => 'UNT-03',
                        'nama' => 'Ruko Sentra Niaga Boulevard No. 08',
                        'kategori' => 'Ruko',
                        'lokasi' => 'Gading Serpong, Tangerang',
                        'tipe' => '3 Lantai • 180 m²',
                        'harga' => 14200000,
                        'status' => 'Tersewa',
                        'penyewa' => 'PT Sumber Cahaya Makmur',
                        'jatuh_tempo' => '01 Des 2026',
                    ],
                    [
                        'id' => 'UNT-04',
                        'nama' => 'Kost Dago Pine Room 204',
                        'kategori' => 'Kost Eksklusif',
                        'lokasi' => 'Coblong, Dago Bandung',
                        'tipe' => 'Deluxe Single • AC & WiFi',
                        'harga' => 2100000,
                        'status' => 'Tersewa',
                        'penyewa' => 'Rizky Pratama',
                        'jatuh_tempo' => '10 Nov 2026',
                    ],
                    [
                        'id' => 'UNT-05',
                        'nama' => 'Kost Dago Pine Room 102',
                        'kategori' => 'Kost Eksklusif',
                        'lokasi' => 'Coblong, Dago Bandung',
                        'tipe' => 'Standard Single',
                        'harga' => 1750000,
                        'status' => 'Perbaikan',
                        'penyewa' => '-',
                        'jatuh_tempo' => '-',
                    ],
                    [
                        'id' => 'UNT-06',
                        'nama' => 'Office Suite Wisma Kencana Lt. 5',
                        'kategori' => 'Kantor',
                        'lokasi' => 'Kuningan, Jakarta Selatan',
                        'tipe' => 'Private Suite • 95 m²',
                        'harga' => 22000000,
                        'status' => 'Tersewa',
                        'penyewa' => 'Kalingga Digital Studio',
                        'jatuh_tempo' => '28 Nov 2026',
                    ],
                ]
            ]);
        }

        if (!session()->has('prosal_tenants')) {
            session([
                'prosal_tenants' => [
                    [
                        'id' => 'TNT-001',
                        'nama' => 'Hendra Gunawan',
                        'unit_id' => 'UNT-01',
                        'unit_nama' => 'Apartemen Grand Sudirman Lt. 14 B',
                        'telepon' => '081288991234',
                        'email' => 'hendra.gunawan@gmail.com',
                        'mulai_sewa' => '15 Mei 2025',
                        'akhir_sewa' => '15 Mei 2027',
                        'status_pembayaran' => 'Lunas',
                        'nominal_sewa' => 8500000,
                    ],
                    [
                        'id' => 'TNT-002',
                        'nama' => 'PT Sumber Cahaya Makmur',
                        'unit_id' => 'UNT-03',
                        'unit_nama' => 'Ruko Sentra Niaga Boulevard No. 08',
                        'telepon' => '082199003344',
                        'email' => 'finance@sumbercahaya.co.id',
                        'mulai_sewa' => '01 Des 2024',
                        'akhir_sewa' => '01 Des 2026',
                        'status_pembayaran' => 'Lunas',
                        'nominal_sewa' => 14200000,
                    ],
                    [
                        'id' => 'TNT-003',
                        'nama' => 'Rizky Pratama',
                        'unit_id' => 'UNT-04',
                        'unit_nama' => 'Kost Dago Pine Room 204',
                        'telepon' => '085711223344',
                        'email' => 'rizky.pratama@student.itb.ac.id',
                        'mulai_sewa' => '10 Agu 2026',
                        'akhir_sewa' => '10 Agu 2027',
                        'status_pembayaran' => 'Menunggu Pembayaran',
                        'nominal_sewa' => 2100000,
                    ],
                    [
                        'id' => 'TNT-004',
                        'nama' => 'Kalingga Digital Studio',
                        'unit_id' => 'UNT-06',
                        'unit_nama' => 'Office Suite Wisma Kencana Lt. 5',
                        'telepon' => '081377889900',
                        'email' => 'operations@kalinggastudio.id',
                        'mulai_sewa' => '28 Nov 2025',
                        'akhir_sewa' => '28 Nov 2027',
                        'status_pembayaran' => 'Lunas',
                        'nominal_sewa' => 22000000,
                    ],
                ]
            ]);
        }

        if (!session()->has('prosal_maintenance')) {
            session([
                'prosal_maintenance' => [
                    [
                        'id' => 'MNT-101',
                        'unit' => 'Kost Dago Pine Room 102',
                        'keluhan' => 'Water heater kamar mandi tidak panas & saklar otomatis mati.',
                        'pelapor' => 'Pengelola Cabang (Inspeksi)',
                        'prioritas' => 'Sedang',
                        'status' => 'Dalam Pengerjaan',
                        'teknisi' => 'Supri (Teknisi Listrik)',
                        'tanggal' => '28 Okt 2026',
                    ],
                    [
                        'id' => 'MNT-102',
                        'unit' => 'Apartemen Grand Sudirman Lt. 14 B',
                        'keluhan' => 'Service berkala filter AC master bedroom & cuci freon.',
                        'pelapor' => 'Bpk. Hendra Gunawan',
                        'prioritas' => 'Rendah',
                        'status' => 'Menunggu Jadwal',
                        'teknisi' => 'Mitra CoolCare AC',
                        'tanggal' => '29 Okt 2026',
                    ],
                    [
                        'id' => 'MNT-103',
                        'unit' => 'Ruko Sentra Niaga Boulevard No. 08',
                        'keluhan' => 'Pipa pembuangan talang air lantai 3 tersumbat daun.',
                        'pelapor' => 'Staff Kantor Tenant',
                        'prioritas' => 'Tinggi',
                        'status' => 'Selesai',
                        'teknisi' => 'Tim Maintenance Ruko',
                        'tanggal' => '25 Okt 2026',
                    ],
                ]
            ]);
        }
    }

    /**
     * Dashboard Utama L-Prosal (Overview & Analitik)
     * Dapat diakses baik dengan login (akun langganan) maupun tanpa login (mode demo pratinjau).
     */
    public function index(Request $request)
    {
        $this->initSessionData();

        $units = session('prosal_units', []);
        $tenants = session('prosal_tenants', []);
        $maintenance = session('prosal_maintenance', []);

        $totalUnits = count($units);
        $terisiUnits = count(array_filter($units, fn($u) => $u['status'] === 'Tersewa'));
        $kosongUnits = count(array_filter($units, fn($u) => $u['status'] === 'Tersedia'));
        $perbaikanUnits = count(array_filter($units, fn($u) => $u['status'] === 'Perbaikan'));

        $okupansiPersen = $totalUnits > 0 ? round(($terisiUnits / $totalUnits) * 100, 1) : 0;

        $totalPendapatanBulanan = array_reduce(
            array_filter($units, fn($u) => $u['status'] === 'Tersewa'),
            fn($acc, $u) => $acc + $u['harga'],
            0
        );

        $pendingMaintenance = count(array_filter($maintenance, fn($m) => $m['status'] !== 'Selesai'));

        $isSubscriber = auth()->check();
        $user = auth()->user();

        return view('prosal.dashboard', compact(
            'units',
            'tenants',
            'maintenance',
            'totalUnits',
            'terisiUnits',
            'kosongUnits',
            'perbaikanUnits',
            'okupansiPersen',
            'totalPendapatanBulanan',
            'pendingMaintenance',
            'isSubscriber',
            'user'
        ));
    }

    /**
     * Halaman Manajemen Unit Properti
     */
    public function unit()
    {
        $this->initSessionData();
        $units = session('prosal_units', []);
        $isSubscriber = auth()->check();

        return view('prosal.unit', compact('units', 'isSubscriber'));
    }

    /**
     * Tambah Unit Baru (disimpan ke Session)
     */
    public function storeUnit(Request $request)
    {
        $this->initSessionData();
        $units = session('prosal_units', []);

        $newUnit = [
            'id' => 'UNT-' . str_pad(count($units) + 1, 2, '0', STR_PAD_LEFT),
            'nama' => $request->input('nama', 'Unit Properti Baru'),
            'kategori' => $request->input('kategori', 'Apartemen'),
            'lokasi' => $request->input('lokasi', 'Jakarta Selatan'),
            'tipe' => $request->input('tipe', 'Standar'),
            'harga' => (int) $request->input('harga', 5000000),
            'status' => $request->input('status', 'Tersedia'),
            'penyewa' => '-',
            'jatuh_tempo' => '-',
        ];

        array_unshift($units, $newUnit);
        session(['prosal_units' => $units]);

        return redirect()->back()->with('success', 'Unit properti baru berhasil ditambahkan!');
    }

    /**
     * Halaman Manajemen Penyewa / Tenant
     */
    public function penyewa()
    {
        $this->initSessionData();
        $tenants = session('prosal_tenants', []);
        $units = session('prosal_units', []);
        $isSubscriber = auth()->check();

        return view('prosal.penyewa', compact('tenants', 'units', 'isSubscriber'));
    }

    /**
     * Tambah Penyewa Baru
     */
    public function storePenyewa(Request $request)
    {
        $this->initSessionData();
        $tenants = session('prosal_tenants', []);
        $units = session('prosal_units', []);

        $unitId = $request->input('unit_id');
        $unitNama = 'Unit Dipilih';

        foreach ($units as &$u) {
            if ($u['id'] === $unitId) {
                $unitNama = $u['nama'];
                $u['status'] = 'Tersewa';
                $u['penyewa'] = $request->input('nama');
                $u['jatuh_tempo'] = $request->input('jatuh_tempo', date('d M Y', strtotime('+1 month')));
                break;
            }
        }
        session(['prosal_units' => $units]);

        $newTenant = [
            'id' => 'TNT-' . str_pad(count($tenants) + 1, 3, '0', STR_PAD_LEFT),
            'nama' => $request->input('nama'),
            'unit_id' => $unitId,
            'unit_nama' => $unitNama,
            'telepon' => $request->input('telepon'),
            'email' => $request->input('email', '-'),
            'mulai_sewa' => date('d M Y'),
            'akhir_sewa' => $request->input('akhir_sewa', date('d M Y', strtotime('+1 year'))),
            'status_pembayaran' => 'Lunas',
            'nominal_sewa' => (int) $request->input('nominal_sewa', 5000000),
        ];

        array_unshift($tenants, $newTenant);
        session(['prosal_tenants' => $tenants]);

        return redirect()->back()->with('success', 'Data penyewa baru berhasil didaftarkan!');
    }

    /**
     * Halaman Tagihan & Keuangan
     */
    public function keuangan()
    {
        $this->initSessionData();
        $tenants = session('prosal_tenants', []);
        $units = session('prosal_units', []);
        $isSubscriber = auth()->check();

        return view('prosal.keuangan', compact('tenants', 'units', 'isSubscriber'));
    }

    /**
     * Halaman Tiket Maintenance & Keluhan
     */
    public function maintenance()
    {
        $this->initSessionData();
        $maintenance = session('prosal_maintenance', []);
        $units = session('prosal_units', []);
        $isSubscriber = auth()->check();

        return view('prosal.maintenance', compact('maintenance', 'units', 'isSubscriber'));
    }

    /**
     * Buat Tiket Maintenance Baru
     */
    public function storeMaintenance(Request $request)
    {
        $this->initSessionData();
        $maintenance = session('prosal_maintenance', []);

        $newTicket = [
            'id' => 'MNT-' . rand(110, 990),
            'unit' => $request->input('unit', 'Unit Properti'),
            'keluhan' => $request->input('keluhan', 'Perbaikan fasilitas'),
            'pelapor' => $request->input('pelapor', 'Penyewa'),
            'prioritas' => $request->input('prioritas', 'Sedang'),
            'status' => 'Menunggu Jadwal',
            'teknisi' => $request->input('teknisi', 'Belum Ditugaskan'),
            'tanggal' => date('d M Y'),
        ];

        array_unshift($maintenance, $newTicket);
        session(['prosal_maintenance' => $maintenance]);

        return redirect()->back()->with('success', 'Tiket keluhan & maintenance berhasil dibuat!');
    }

    /**
     * Reset Demo Data
     */
    public function resetData()
    {
        session()->forget(['prosal_units', 'prosal_tenants', 'prosal_maintenance']);
        return redirect()->route('prosal.dashboard')->with('success', 'Data demo L-Prosal berhasil di-reset ke kondisi awal!');
    }
}

