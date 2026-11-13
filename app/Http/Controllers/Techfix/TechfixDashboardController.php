<?php

namespace App\Http\Controllers\Techfix;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TechfixDashboardController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // PERSISTENT STORAGE HELPERS (data bertahan walau logout)
    // ─────────────────────────────────────────────────────────────────────────

    private function getTechfixData(string $key, $default = [])
    {
        $path = storage_path('app/techfix_data.json');
        if (!file_exists($path)) {
            return session('techfix_' . $key, $default);
        }
        $all = json_decode(file_get_contents($path), true) ?? [];
        return $all[$key] ?? session('techfix_' . $key, $default);
    }

    private function saveTechfixData(string $key, $value): void
    {
        $path = storage_path('app/techfix_data.json');
        $all  = file_exists($path) ? (json_decode(file_get_contents($path), true) ?? []) : [];
        $all[$key] = $value;
        file_put_contents($path, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        session(['techfix_' . $key => $value]);
    }

    // ─────────────────────────────────────────────────────────────────────────

    /**
     * Data kosong (clean slate) - Siap diisi sendiri oleh pengguna.
     */
    private function getEmptyData()
    {
        return [
            'branch' => 'Cabang Mangga Dua Mall Lt. 3',
            'shift'  => 'Shift 1 (Pagi - Sore)',
            'stats'  => [
                'tiket_aktif'       => ['val' => '0', 'unit' => 'Unit', 'sub' => '+0 unit masuk hari ini'],
                'pending_approval'  => ['val' => '0', 'unit' => 'Tiket', 'sub' => 'Rp 0 tertunda'],
                'sedang_diperbaiki' => ['val' => '0', 'unit' => 'Unit', 'sub' => 'Avg lead time: 0 hari'],
                'qc_siap_diambil'   => ['val' => '0', 'unit' => 'Unit', 'sub' => 'Siap serah terima kasir'],
                'rasio_sukses'      => ['val' => '0%', 'unit' => '', 'badge' => 'Standby', 'sub' => 'Target: >90%'],
            ],
            'tiket_diagnosa'   => [],
            'tiket_approval'   => [],
            'tiket_dikerjakan' => [],
            'tiket_qc'         => [],
            'hardware_diag'    => [
                ['label' => 'LAN Workshop',    'ip' => '192.168.1.10', 'status' => 'Online',  'color' => 'text-emerald-500'],
                ['label' => 'QR Scanner',     'ip' => 'Siap (COM4)',  'status' => 'Ready',   'color' => 'text-blue-500'],
                ['label' => 'Thermal Printer','ip' => 'Ready 80mm',   'status' => 'Ready',   'color' => 'text-blue-500'],
            ],
        ];
    }

    /**
     * Tampilkan dashboard utama TechFix Pro — Service Center & Hardware Repair.
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil data dari persistent file storage (atau session sebagai fallback)
        $currentBranch   = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $currentDate     = \Carbon\Carbon::now()->translatedFormat('l, d F Y');
        $shiftStatus     = session('techfix_shift', 'Shift 1 (Pagi - Sore)');

        // Data Tiket Kanban dari file storage (persisten)
        $tiketDiagnosa   = $this->getTechfixData('tiket_diagnosa', []);
        $tiketApproval   = $this->getTechfixData('tiket_approval', []);
        $tiketDikerjakan = $this->getTechfixData('tiket_dikerjakan', []);
        $tiketQc         = $this->getTechfixData('tiket_qc', []);

        // Sinkronisasi angka statistik berdasarkan isi tiket riil
        $totalAktif = count($tiketDiagnosa) + count($tiketApproval) + count($tiketDikerjakan) + count($tiketQc);
        $stats = [
            'tiket_aktif'       => ['val' => (string) $totalAktif, 'unit' => 'Unit', 'sub' => "+{$totalAktif} unit dalam sistem"],
            'pending_approval'  => ['val' => (string) count($tiketApproval), 'unit' => 'Tiket', 'sub' => 'Menunggu konfirmasi biaya'],
            'sedang_diperbaiki' => ['val' => (string) count($tiketDikerjakan), 'unit' => 'Unit', 'sub' => 'Sedang dalam pengerjaan teknisi'],
            'qc_siap_diambil'   => ['val' => (string) count($tiketQc), 'unit' => 'Unit', 'sub' => 'Siap serah terima ke kasir'],
            'rasio_sukses'      => ['val' => $totalAktif > 0 ? '100%' : '0%', 'unit' => '', 'badge' => $totalAktif > 0 ? 'Optimal' : 'Standby', 'sub' => 'Target: >90%'],
        ];

        // Kumpulkan semua tiket untuk pencarian detail
        $allTikets = array_merge($tiketDiagnosa, $tiketApproval, $tiketDikerjakan, $tiketQc);

        $selectedTiketId = request()->query('tiket');
        $selectedTiket   = null;

        if ($selectedTiketId) {
            foreach ($allTikets as $t) {
                if (($t['id'] ?? null) === $selectedTiketId) {
                    $selectedTiket = $t;
                    break;
                }
            }
        } elseif (!empty($allTikets)) {
            $selectedTiket = $allTikets[0];
        }

        $hardwareDiag = $this->getEmptyData()['hardware_diag'];

        return view('techfix.dashboard', compact(
            'user',
            'currentBranch',
            'currentDate',
            'shiftStatus',
            'stats',
            'tiketDiagnosa',
            'tiketApproval',
            'tiketDikerjakan',
            'tiketQc',
            'selectedTiket',
            'hardwareDiag'
        ));
    }

    /**
     * Buat tiket servis baru.
     */
    public function storeTiket(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'device'         => 'required|string|max:255',
            'keluhan'        => 'required|string',
        ]);

        $listDiagnosa = $this->getTechfixData('tiket_diagnosa', []);
        $allCount = count(array_merge(
            $this->getTechfixData('tiket_diagnosa', []),
            $this->getTechfixData('tiket_approval', []),
            $this->getTechfixData('tiket_dikerjakan', []),
            $this->getTechfixData('tiket_qc', [])
        ));
        
        $newId = 'TK-' . (9901 + $allCount);

        $tiket = [
            'id'             => $newId,
            'kode'           => '#' . $newId,
            'priority'       => $request->input('priority', 'Regular'),
            'device'         => $request->device,
            'device_detail'  => $request->device,
            'serial'         => $request->input('serial', 'SN-' . strtoupper(substr(md5(uniqid()), 0, 8))),
            'keluhan'        => '"' . $request->keluhan . '"',
            'box_label'      => 'GEJALA KERUSAKAN:',
            'nama_pelanggan' => $request->nama_pelanggan,
            'phone'          => $request->input('phone', '+62 812-0000-0000'),
            'teknisi'        => $request->input('teknisi', 'Belum Assign'),
            'teknisi_station'=> $request->input('teknisi', 'Antrian Diagnosa'),
            'kelengkapan'    => $request->input('kelengkapan', 'Unit Only'),
            'time_ago'       => 'Baru saja',
            'status'         => 'Diagnosa Awal',
            'progress'       => 15,
            'estimasi_biaya' => $request->input('estimasi_biaya', 'Rp 0'),
            'investigasi'    => 'Menunggu inspeksi detail tegangan motherboard & mikrosolder oleh teknisi penanggung jawab.',
            'solusi'         => 'Pembersihan jalur, isolasi komponen rusak, dan uji fungsi dasar.',
            'level_reparasi' => 'Diagnosa L1',
            'durasi'         => 'Baru masuk',
            'tracking_url'   => 'https://track.techfix.id/' . $newId,
            'wa_status'      => 'Baru Terdaftar',
            'rails'          => [
                ['label' => 'PPBUS_G3H', 'val' => '12.00V', 'status' => 'PASS', 'type' => 'pass'],
                ['label' => 'PP3V3_G3H', 'val' => '3.30V',  'status' => 'PASS', 'type' => 'pass'],
                ['label' => 'MAIN_PWR',  'val' => '19.00V', 'status' => 'PASS', 'type' => 'pass'],
                ['label' => 'STANDBY',   'val' => '5.00V',  'status' => 'PASS', 'type' => 'pass'],
            ],
            'items'          => [
                ['nama' => 'Jasa Diagnosa & Inspeksi Hardware', 'desc' => 'Uji kelistrikan & komponen', 'biaya' => $request->input('estimasi_biaya', 'Rp 50.000'), 'harga' => 50000],
            ],
            'subtotal'       => $request->input('estimasi_biaya', 'Rp 50.000'),
            'diskon'         => '- Rp 0',
            'total'          => $request->input('estimasi_biaya', 'Rp 50.000'),
        ];

        array_unshift($listDiagnosa, $tiket);
        $this->saveTechfixData('tiket_diagnosa', $listDiagnosa);

        return redirect()->route('techfix.dashboard', ['tiket' => $newId])
            ->with('success', "Tiket servis {$newId} untuk '{$request->nama_pelanggan}' berhasil didaftarkan!");
    }

    /**
     * Tambah item sparepart/jasa ke tiket aktif
     */
    public function addItem(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string',
            'biaya' => 'required|numeric',
        ]);

        $columns = ['tiket_diagnosa', 'tiket_approval', 'tiket_dikerjakan', 'tiket_qc'];
        foreach ($columns as $col) {
            $list = $this->getTechfixData($col, []);
            foreach ($list as &$t) {
                if (($t['id'] ?? '') === $id) {
                    $items = $t['items'] ?? [];
                    $items[] = [
                        'nama'  => $request->nama,
                        'desc'  => $request->input('desc', 'Komponen tambahan teknisi'),
                        'biaya' => 'Rp ' . number_format($request->biaya, 0, ',', '.'),
                        'harga' => (int) $request->biaya,
                    ];
                    $t['items'] = $items;
                    
                    // Hitung total
                    $totalHarga = array_sum(array_column($items, 'harga'));
                    $t['subtotal'] = 'Rp ' . number_format($totalHarga, 0, ',', '.');
                    $t['total']    = 'Rp ' . number_format($totalHarga, 0, ',', '.');
                    $t['estimasi_biaya'] = $t['total'];
                    break 2;
                }
            }
            $this->saveTechfixData($col, $list);
        }

        return redirect()->route('techfix.dashboard', ['tiket' => $id])
            ->with('success', "Item sparepart / jasa berhasil ditambahkan ke tiket {$id}!");
    }

    /**
     * Update status tiket (pindah kolom Kanban).
     */
    public function updateStatusTiket(Request $request, $id)
    {
        $targetStatus = $request->input('status', 'Diagnosa Awal');

        $columns = [
            'Diagnosa Awal'     => 'tiket_diagnosa',
            'Approval WA'       => 'tiket_approval',
            'Sedang Dikerjakan' => 'tiket_dikerjakan',
            'QC & Siap Diambil' => 'tiket_qc',
        ];

        $foundTiket = null;
        foreach ($columns as $statusKey => $dataKey) {
            $list = $this->getTechfixData($dataKey, []);
            foreach ($list as $key => $t) {
                if (($t['id'] ?? null) === $id) {
                    $foundTiket = $t;
                    unset($list[$key]);
                    $this->saveTechfixData($dataKey, array_values($list));
                    break 2;
                }
            }
        }

        if ($foundTiket) {
            $foundTiket['status'] = $targetStatus;
            $destKey = $columns[$targetStatus] ?? 'tiket_diagnosa';
            $destList = $this->getTechfixData($destKey, []);
            array_unshift($destList, $foundTiket);
            $this->saveTechfixData($destKey, $destList);
        }

        return redirect()->route('techfix.dashboard', ['tiket' => $id])
            ->with('success', "Status tiket {$id} diperbarui menjadi '{$targetStatus}'!");
    }

    /**
     * Ganti Cabang
     */
    public function switchBranch(Request $request)
    {
        $branches = [
            'Cabang Mangga Dua Mall Lt. 3',
            'Cabang Ratu Plaza Lt. 2',
            'Cabang Harco Mangga Dua Blok B',
            'Cabang ITC Roxy Mas Lt. 1',
        ];

        $current = session('techfix_branch', $branches[0]);
        $currentIndex = array_search($current, $branches);
        $nextIndex = ($currentIndex === false || $currentIndex + 1 >= count($branches)) ? 0 : $currentIndex + 1;
        $nextBranch = $branches[$nextIndex];

        session(['techfix_branch' => $nextBranch]);

        return redirect()->route('techfix.dashboard')
            ->with('success', "Cabang aktif dialihkan ke: {$nextBranch}");
    }

    /**
     * Toggle Shift Kerja
     */
    public function toggleShift()
    {
        $current = session('techfix_shift', 'Shift 1 (Pagi - Sore)');
        $next = ($current === 'Shift 1 (Pagi - Sore)') ? 'Shift 2 (Sore - Malam)' : 'Shift 1 (Pagi - Sore)';
        session(['techfix_shift' => $next]);

        return redirect()->route('techfix.dashboard')
            ->with('success', "Shift kerja diubah ke {$next}");
    }

    /**
     * Reset / Kosongkan Data
     */
    public function resetData()
    {
        // Hapus file persistent storage
        $path = storage_path('app/techfix_data.json');
        if (file_exists($path)) {
            unlink($path);
        }

        $empty = $this->getEmptyData();
        session([
            'techfix_initialized'      => true,
            'techfix_branch'           => $empty['branch'],
            'techfix_shift'            => $empty['shift'],
            'techfix_stats'            => $empty['stats'],
            'techfix_tiket_diagnosa'   => [],
            'techfix_tiket_approval'   => [],
            'techfix_tiket_dikerjakan' => [],
            'techfix_tiket_qc'         => [],
            'techfix_wa_approvals'     => [],
            'techfix_kasir_transaksi'  => [],
            'techfix_kasir_garansi'    => [],
            'techfix_stok_parts'       => [],
        ]);

        return redirect()->route('techfix.dashboard')
            ->with('success', 'Semua data tiket telah dikosongkan! Dashboard siap diisi mandiri.');
    }

    /**
     * Muat Data Demo Lengkap Techfix
     */
    public function loadDemoData()
    {
        $now = \Carbon\Carbon::now();

        $tiketDiagnosa = [
            [
                'id'             => 'TK-9901',
                'kode'           => '#TK-9901',
                'priority'       => 'Urgent',
                'device'         => 'MacBook Pro 14" M2 (2023)',
                'device_detail'  => 'MacBook Pro 14" M2 (2023)',
                'serial'         => 'SN-C02XW2FMJGH5',
                'keluhan'        => '"Layar flickering setelah update macOS Sonoma, kadang blank total"',
                'box_label'      => 'GEJALA KERUSAKAN:',
                'nama_pelanggan' => 'Bpk. Renaldi Firmansyah',
                'phone'          => '+62 821-5544-9988',
                'teknisi'        => 'Fadhil Irawan',
                'teknisi_station'=> 'Bench A - Display & Logic Board',
                'kelengkapan'    => 'Unit + Charger 96W',
                'time_ago'       => '45 menit lalu',
                'status'         => 'Diagnosa Awal',
                'progress'       => 20,
                'estimasi_biaya' => 'Rp 850.000',
                'investigasi'    => 'Kemungkinan kerusakan pada konektor eDP layar atau T2 chip. Perlu uji LCD panel terpisah.',
                'solusi'         => 'Penggantian kabel fleksibel LCD dan kalibrasi ulang display controller.',
                'level_reparasi' => 'Diagnosa L2',
                'durasi'         => '45 menit',
                'tracking_url'   => 'https://track.techfix.id/TK-9901',
                'wa_status'      => 'Baru Terdaftar',
                'rails'          => [
                    ['label' => 'PPBUS_G3H', 'val' => '12.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'PP3V3_G3H', 'val' => '3.30V',  'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'MAIN_PWR',  'val' => '19.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'GPU_RAIL',  'val' => '0.85V',  'status' => 'WARN', 'type' => 'warn'],
                ],
                'items' => [
                    ['nama' => 'Jasa Diagnosa Hardware', 'desc' => 'Uji layar & logic board', 'biaya' => 'Rp 150.000', 'harga' => 150000],
                ],
                'subtotal' => 'Rp 150.000',
                'diskon'   => '- Rp 0',
                'total'    => 'Rp 150.000',
            ],
            [
                'id'             => 'TK-9902',
                'kode'           => '#TK-9902',
                'priority'       => 'Regular',
                'device'         => 'ASUS ROG Strix G16 RTX 4070',
                'device_detail'  => 'ASUS ROG Strix G16 RTX 4070',
                'serial'         => 'SN-ROG7X2024ABC',
                'keluhan'        => '"Laptop overheat dan throttling saat gaming, suhu CPU mencapai 102°C"',
                'box_label'      => 'GEJALA KERUSAKAN:',
                'nama_pelanggan' => 'Vicky Prasetyo',
                'phone'          => '+62 877-8899-1234',
                'teknisi'        => 'Hendra Gunawan',
                'teknisi_station'=> 'Bench B - Thermal & Cooling',
                'kelengkapan'    => 'Unit Only',
                'time_ago'       => '2 jam lalu',
                'status'         => 'Diagnosa Awal',
                'progress'       => 35,
                'estimasi_biaya' => 'Rp 350.000',
                'investigasi'    => 'Pasta thermal sudah kering dan heat pipe kotor. Fan berputar tidak optimal.',
                'solusi'         => 'Repaste dengan Thermal Grizzly Kryonaut + cleaning cooling system.',
                'level_reparasi' => 'Servis L1',
                'durasi'         => '2 jam',
                'tracking_url'   => 'https://track.techfix.id/TK-9902',
                'wa_status'      => 'Notifikasi Terkirim',
                'rails'          => [
                    ['label' => 'PPBUS_G3H', 'val' => '12.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'PP3V3_G3H', 'val' => '3.30V',  'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'MAIN_PWR',  'val' => '19.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'STANDBY',   'val' => '5.00V',  'status' => 'PASS', 'type' => 'pass'],
                ],
                'items' => [
                    ['nama' => 'Jasa Repaste CPU/GPU', 'desc' => 'Thermal Grizzly Kryonaut', 'biaya' => 'Rp 250.000', 'harga' => 250000],
                    ['nama' => 'Cleaning Fan Cooling',  'desc' => 'Dust removal + fan check',  'biaya' => 'Rp 100.000', 'harga' => 100000],
                ],
                'subtotal' => 'Rp 350.000',
                'diskon'   => '- Rp 0',
                'total'    => 'Rp 350.000',
            ],
        ];

        $tiketApproval = [
            [
                'id'             => 'TK-9903',
                'kode'           => '#TK-9903',
                'priority'       => 'High',
                'device'         => 'iPhone 15 Pro Max 256GB',
                'device_detail'  => 'iPhone 15 Pro Max 256GB (Natural Titanium)',
                'serial'         => 'SN-F4GT9X8HAB12',
                'keluhan'        => '"Tombol volume bawah tidak responsif, sesekali baterai drop mendadak ke 0%"',
                'box_label'      => 'GEJALA KERUSAKAN:',
                'nama_pelanggan' => 'Ibu Salsabila Ramadhani',
                'phone'          => '+62 813-2211-5566',
                'teknisi'        => 'Fadhil Irawan',
                'teknisi_station'=> 'Bench C - iOS & iPhone Repair',
                'kelengkapan'    => 'Unit + Case',
                'time_ago'       => '3 jam lalu',
                'status'         => 'Approval WA',
                'progress'       => 55,
                'estimasi_biaya' => 'Rp 1.750.000',
                'investigasi'    => 'Flex volume button rusak, baterai BMS menunjukkan cycle count 850+. Perlu penggantian keduanya.',
                'solusi'         => 'Penggantian flex volume + penggantian baterai OEM 100% health.',
                'level_reparasi' => 'Reparasi L2',
                'durasi'         => '3 jam',
                'tracking_url'   => 'https://track.techfix.id/TK-9903',
                'wa_status'      => 'Menunggu Konfirmasi Customer',
                'rails'          => [
                    ['label' => 'PPBUS_G3H', 'val' => '5.00V',  'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'PP3V3_G3H', 'val' => '3.30V',  'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'BATT_RAIL',  'val' => '3.68V',  'status' => 'WARN', 'type' => 'warn'],
                    ['label' => 'STANDBY',   'val' => '1.80V',  'status' => 'PASS', 'type' => 'pass'],
                ],
                'items' => [
                    ['nama' => 'Flex Volume Button iPhone 15 PM', 'desc' => 'Part OEM Grade A', 'biaya' => 'Rp 450.000', 'harga' => 450000],
                    ['nama' => 'Baterai iPhone 15 PM OEM',       'desc' => 'Health 100% BMS',  'biaya' => 'Rp 950.000', 'harga' => 950000],
                    ['nama' => 'Jasa Reparasi',                  'desc' => 'Teknisi bersertifikat', 'biaya' => 'Rp 350.000', 'harga' => 350000],
                ],
                'subtotal' => 'Rp 1.750.000',
                'diskon'   => '- Rp 0',
                'total'    => 'Rp 1.750.000',
            ],
        ];

        $tiketDikerjakan = [
            [
                'id'             => 'TK-9904',
                'kode'           => '#TK-9904',
                'priority'       => 'Regular',
                'device'         => 'Lenovo ThinkPad X1 Carbon Gen 11',
                'device_detail'  => 'Lenovo ThinkPad X1 Carbon Gen 11 (i7-1365U)',
                'serial'         => 'SN-PF4B2X9ULN',
                'keluhan'        => '"SSD tidak terdeteksi setelah BIOS update. Data penting masih di dalam."',
                'box_label'      => 'GEJALA KERUSAKAN:',
                'nama_pelanggan' => 'PT. Maju Digital Nusantara (Pak Dani)',
                'phone'          => '+62 811-9988-7765',
                'teknisi'        => 'Hendra Gunawan',
                'teknisi_station'=> 'Bench A - Storage & Data Recovery',
                'kelengkapan'    => 'Unit + Docking Station',
                'time_ago'       => '5 jam lalu',
                'status'         => 'Sedang Dikerjakan',
                'progress'       => 70,
                'estimasi_biaya' => 'Rp 2.500.000',
                'investigasi'    => 'NVMe SSD M.2 2280 mengalami bad sector. BIOS update menyebabkan konflik firmware controller.',
                'solusi'         => 'Recovery data via specialized tools + penggantian SSD Samsung 990 Pro 512GB.',
                'level_reparasi' => 'Reparasi L3 - Data Recovery',
                'durasi'         => '5 jam',
                'tracking_url'   => 'https://track.techfix.id/TK-9904',
                'wa_status'      => 'Update Dikirim',
                'rails'          => [
                    ['label' => 'PPBUS_G3H', 'val' => '12.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'PP3V3_G3H', 'val' => '3.30V',  'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'NVME_RAIL', 'val' => '3.30V',  'status' => 'FAIL', 'type' => 'fail'],
                    ['label' => 'STANDBY',   'val' => '5.00V',  'status' => 'PASS', 'type' => 'pass'],
                ],
                'items' => [
                    ['nama' => 'Samsung 990 Pro 512GB NVMe', 'desc' => 'Pengganti SSD rusak', 'biaya' => 'Rp 1.200.000', 'harga' => 1200000],
                    ['nama' => 'Jasa Data Recovery L3',      'desc' => 'Specialized tools',   'biaya' => 'Rp 1.000.000', 'harga' => 1000000],
                    ['nama' => 'Jasa Reparasi & Testing',    'desc' => 'Full system test',     'biaya' => 'Rp 300.000',   'harga' => 300000],
                ],
                'subtotal' => 'Rp 2.500.000',
                'diskon'   => '- Rp 0',
                'total'    => 'Rp 2.500.000',
            ],
        ];

        $tiketQc = [
            [
                'id'             => 'TK-9905',
                'kode'           => '#TK-9905',
                'priority'       => 'Regular',
                'device'         => 'Samsung Galaxy S23 Ultra 512GB',
                'device_detail'  => 'Samsung Galaxy S23 Ultra 512GB (Phantom Black)',
                'serial'         => 'SN-R5CRBX0AXYZ89',
                'keluhan'        => '"Layar AMOLED retak bagian bawah, touch screen masih fungsi sebagian"',
                'box_label'      => 'GEJALA KERUSAKAN:',
                'nama_pelanggan' => 'Rizky Maulana Akbar',
                'phone'          => '+62 858-7766-4321',
                'teknisi'        => 'Fadhil Irawan',
                'teknisi_station'=> 'Bench D - Display Replacement',
                'kelengkapan'    => 'Unit + S-Pen',
                'time_ago'       => '1 hari lalu',
                'status'         => 'QC & Siap Diambil',
                'progress'       => 95,
                'estimasi_biaya' => 'Rp 3.200.000',
                'investigasi'    => 'LCD AMOLED retak parah, digitizer masih parsial. Penggantian panel lengkap diperlukan.',
                'solusi'         => 'Penggantian AMOLED panel original Samsung + kalibrasi S-Pen + screen protector.',
                'level_reparasi' => 'Penggantian Part L2',
                'durasi'         => '1 hari',
                'tracking_url'   => 'https://track.techfix.id/TK-9905',
                'wa_status'      => 'Siap Diambil - Sudah Notifikasi',
                'rails'          => [
                    ['label' => 'PPBUS_G3H', 'val' => '5.00V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'PP3V3_G3H', 'val' => '3.30V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'MAIN_PWR',  'val' => '4.35V', 'status' => 'PASS', 'type' => 'pass'],
                    ['label' => 'STANDBY',   'val' => '1.80V', 'status' => 'PASS', 'type' => 'pass'],
                ],
                'items' => [
                    ['nama' => 'AMOLED Panel Samsung S23 Ultra OEM', 'desc' => 'Original Samsung Part', 'biaya' => 'Rp 2.400.000', 'harga' => 2400000],
                    ['nama' => 'Jasa Penggantian LCD',                'desc' => 'Teknisi bersertifikat', 'biaya' => 'Rp 500.000',   'harga' => 500000],
                    ['nama' => 'Screen Protector Tempered Glass',     'desc' => 'Gratis pemasangan',    'biaya' => 'Rp 300.000',   'harga' => 300000],
                ],
                'subtotal' => 'Rp 3.200.000',
                'diskon'   => '- Rp 0',
                'total'    => 'Rp 3.200.000',
            ],
        ];

        $stokParts = [
            [
                'id'            => 'PART-1001',
                'part_number'   => 'BAT-IP15PM-OEM',
                'nama'          => 'Baterai iPhone 15 Pro Max OEM (4422mAh)',
                'deskripsi'     => 'Original Equipment Manufacturer Grade A+ High Density Cell',
                'kategori'      => 'Baterai Laptop',
                'kategori_slug' => 'baterailaptop',
                'kompatibel'    => 'iPhone 15 Pro Max (A2849, A3101)',
                'stok_gudang'   => 8,
                'stok_toko'     => 2,
                'stok_min'      => 4,
                'harga_modal'   => 550000,
                'harga_jual'    => 950000,
                'supplier'      => 'iFixit Indonesia',
                'status_stok'   => 'aman',
                'icon'          => 'fa-solid fa-battery-half',
                'terpasang'     => 5,
                'created_at'    => now()->subDays(5)->format('d M Y H:i'),
            ],
            [
                'id'            => 'PART-1002',
                'part_number'   => 'LCD-S23U-AMOLED',
                'nama'          => 'Samsung AMOLED S23 Ultra Complete Panel',
                'deskripsi'     => 'Dynamic AMOLED 2X 120Hz Phantom Black w/ Frame',
                'kategori'      => 'Layar & LCD',
                'kategori_slug' => 'layarlcd',
                'kompatibel'    => 'Samsung S23 Ultra 5G (SM-S918B)',
                'stok_gudang'   => 3,
                'stok_toko'     => 1,
                'stok_min'      => 2,
                'harga_modal'   => 1800000,
                'harga_jual'    => 2400000,
                'supplier'      => 'Samsung Part ID',
                'status_stok'   => 'menipis',
                'icon'          => 'fa-solid fa-desktop',
                'terpasang'     => 2,
                'created_at'    => now()->subDays(4)->format('d M Y H:i'),
            ],
            [
                'id'            => 'PART-1003',
                'part_number'   => 'THM-GRIZZLY-1G',
                'nama'          => 'Thermal Grizzly Kryonaut 1g Extreme Paste',
                'deskripsi'     => '12.5 W/mk High Thermal Conductivity Paste',
                'kategori'      => 'Thermal Material',
                'kategori_slug' => 'thermalmaterial',
                'kompatibel'    => 'All CPU & GPU Chipsets',
                'stok_gudang'   => 15,
                'stok_toko'     => 5,
                'stok_min'      => 5,
                'harga_modal'   => 45000,
                'harga_jual'    => 85000,
                'supplier'      => 'TechParts Mangga Dua',
                'status_stok'   => 'aman',
                'icon'          => 'fa-solid fa-temperature-high',
                'terpasang'     => 12,
                'created_at'    => now()->subDays(10)->format('d M Y H:i'),
            ],
            [
                'id'            => 'PART-1004',
                'part_number'   => 'SSD-SAM-990P-512',
                'nama'          => 'Samsung 990 Pro 512GB PCIe 4.0 NVMe M.2',
                'deskripsi'     => 'Speed 7450 MB/s Read, V-NAND TLC Controller',
                'kategori'      => 'SSD & Storage',
                'kategori_slug' => 'ssdstorage',
                'kompatibel'    => 'Laptop / PC M.2 NVMe 2280 Slot',
                'stok_gudang'   => 1,
                'stok_toko'     => 0,
                'stok_min'      => 2,
                'harga_modal'   => 850000,
                'harga_jual'    => 1200000,
                'supplier'      => 'Samsung Part ID',
                'status_stok'   => 'kritis',
                'icon'          => 'fa-solid fa-hard-drive',
                'terpasang'     => 4,
                'created_at'    => now()->subDays(3)->format('d M Y H:i'),
            ],
            [
                'id'            => 'PART-1005',
                'part_number'   => 'FLX-IP15PM-VOL',
                'nama'          => 'Flex Volume Button iPhone 15 Pro Max',
                'deskripsi'     => 'Volume & Action Button Ribbon Assembly',
                'kategori'      => 'Kabel & Konektor',
                'kategori_slug' => 'kabelkonektor',
                'kompatibel'    => 'iPhone 15 Pro Max',
                'stok_gudang'   => 6,
                'stok_toko'     => 2,
                'stok_min'      => 3,
                'harga_modal'   => 220000,
                'harga_jual'    => 450000,
                'supplier'      => 'iFixit Indonesia',
                'status_stok'   => 'aman',
                'icon'          => 'fa-solid fa-plug',
                'terpasang'     => 3,
                'created_at'    => now()->subDays(6)->format('d M Y H:i'),
            ],
            [
                'id'            => 'PART-1006',
                'part_number'   => 'CBL-MBP14-EDP',
                'nama'          => 'MacBook Pro 14" M2 LCD eDP Display Cable',
                'deskripsi'     => 'Flexible Display Data Bus Ribbon 40-Pin',
                'kategori'      => 'Kabel & Konektor',
                'kategori_slug' => 'kabelkonektor',
                'kompatibel'    => 'MacBook Pro 14" A2779 (2023)',
                'stok_gudang'   => 0,
                'stok_toko'     => 0,
                'stok_min'      => 1,
                'harga_modal'   => 380000,
                'harga_jual'    => 650000,
                'supplier'      => 'Apple Parts ID',
                'status_stok'   => 'kritis',
                'icon'          => 'fa-solid fa-plug',
                'terpasang'     => 1,
                'created_at'    => now()->subDays(2)->format('d M Y H:i'),
            ],
        ];

        $supplierList = [
            [
                'nama'      => 'iFixit Indonesia Distribution',
                'kategori'  => 'Sparepart Apple, Baterai & Tools Mikrosolder',
                'lead_time' => '1 - 2 Hari',
                'rating'    => '4.9/5',
                'kontak'    => '+62 811-3322-1100',
            ],
            [
                'nama'      => 'Samsung Parts Authorized Distributor',
                'kategori'  => 'Panel AMOLED, IC Power & Flex Original',
                'lead_time' => '2 - 3 Hari',
                'rating'    => '4.8/5',
                'kontak'    => '+62 812-4455-6677',
            ],
            [
                'nama'      => 'TechParts Mangga Dua Mall Lt. 4',
                'kategori'  => 'Thermal Material, SSD NVMe, RAM & Heatsink',
                'lead_time' => 'Same-Day (Instan)',
                'rating'    => '4.7/5',
                'kontak'    => '+62 878-9900-1122',
            ],
        ];

        $kasirTransaksi = [
            [
                'id'             => 'TRX-' . $now->format('ymd') . '-001',
                'tiket_id'       => 'TK-9890',
                'nama_pelanggan' => 'Ahmad Fauzi',
                'device'         => 'Xiaomi 13 Pro',
                'jenis'          => 'Servis',
                'total_raw'      => 650000,
                'total'          => 'Rp 650.000',
                'metode_bayar'   => 'QRIS',
                'status_bayar'   => 'lunas',
                'created_at'     => $now->copy()->subHours(3)->format('H:i') . ' WIB',
            ],
            [
                'id'             => 'TRX-' . $now->format('ymd') . '-002',
                'tiket_id'       => 'TK-9891',
                'nama_pelanggan' => 'Dewi Kartika',
                'device'         => 'OPPO Find X6',
                'jenis'          => 'Servis',
                'total_raw'      => 1850000,
                'total'          => 'Rp 1.850.000',
                'metode_bayar'   => 'Transfer BCA',
                'status_bayar'   => 'lunas',
                'created_at'     => $now->copy()->subHours(1)->format('H:i') . ' WIB',
            ],
            [
                'id'             => 'TRX-' . $now->format('ymd') . '-003',
                'tiket_id'       => 'TK-9895',
                'nama_pelanggan' => 'Budi Santoso',
                'device'         => 'Acer Swift 3',
                'jenis'          => 'Garansi',
                'total_raw'      => 0,
                'total'          => 'Rp 0 (Klaim)',
                'metode_bayar'   => 'Klaim Garansi',
                'status_bayar'   => 'lunas',
                'created_at'     => $now->copy()->subHours(4)->format('H:i') . ' WIB',
            ],
        ];

        $kasirGaransi = [
            [
                'id'             => 'GAR-901',
                'tiket_id'       => 'TK-9890',
                'nama_pelanggan' => 'Ahmad Fauzi',
                'device'         => 'Xiaomi 13 Pro (Baterai)',
                'durasi'         => '90 Hari',
                'expired'        => $now->copy()->addDays(85)->format('d M Y'),
                'status'         => 'Aktif',
                'created_at'     => $now->copy()->subDays(5)->format('H:i') . ' WIB',
            ],
            [
                'id'             => 'GAR-902',
                'tiket_id'       => 'TK-9891',
                'nama_pelanggan' => 'Dewi Kartika',
                'device'         => 'OPPO Find X6 (LCD Panel)',
                'durasi'         => '30 Hari',
                'expired'        => $now->copy()->addDays(28)->format('d M Y'),
                'status'         => 'Aktif',
                'created_at'     => $now->copy()->subDays(2)->format('H:i') . ' WIB',
            ],
        ];

        $crmCustomers = [
            [
                'id'                 => 'CUST-A1901',
                'nama'               => 'Bpk. Renaldi Firmansyah',
                'hp'                 => '+62 821-5544-9988',
                'email'              => 'renaldi@firmansyah.id',
                'tipe'               => 'personal',
                'perusahaan'         => '-',
                'alamat'             => 'Apartemen Mediterania Garden 2 Tower H, Jakarta Barat',
                'pembayaran'         => 'qris',
                'term'               => 'cash',
                'catatan'            => 'Pelanggan loyal, selalu request teknisi senior Fadhil',
                'total_servis'       => 3,
                'total_spent'        => 3850000,
                'status'             => 'Aktif',
                'tgl_daftar'         => '15 Jan 2025',
                'jadwal_maintenance' => null,
                'units'              => [
                    [
                        'id'        => 'UNIT-01',
                        'brand'     => 'Apple',
                        'model'     => 'MacBook Pro 14" M2 (2023)',
                        'sn'        => 'SN-C02XW2FMJGH5',
                        'kondisi'   => 'sedang servis',
                        'tgl_masuk' => now()->format('d M Y'),
                        'status'    => 'Aktif',
                    ],
                    [
                        'id'        => 'UNIT-02',
                        'brand'     => 'Apple',
                        'model'     => 'iPhone 14 Pro 128GB',
                        'sn'        => 'SN-F17GH998LK01',
                        'kondisi'   => 'baik',
                        'tgl_masuk' => '10 Feb 2025',
                        'status'    => 'Selesai',
                    ],
                ],
                'riwayat_servis'     => [
                    [
                        'tiket_id' => 'TK-9901',
                        'unit'     => 'MacBook Pro 14" M2',
                        'keluhan'  => 'Layar flickering setelah update macOS',
                        'biaya'    => 850000,
                        'status'   => 'Diagnosa Awal',
                        'tanggal'  => now()->format('d M Y'),
                    ],
                    [
                        'tiket_id' => 'TK-8910',
                        'unit'     => 'iPhone 14 Pro',
                        'keluhan'  => 'Ganti backglass retak & cleaning sensor',
                        'biaya'    => 1200000,
                        'status'   => 'Selesai',
                        'tanggal'  => '15 Feb 2025',
                    ],
                ],
            ],
            [
                'id'                 => 'CUST-B2022',
                'nama'               => 'PT. Maju Digital Nusantara (Pak Dani)',
                'hp'                 => '+62 811-9988-7765',
                'email'              => 'it-support@majudigital.co.id',
                'tipe'               => 'korporat',
                'perusahaan'         => 'PT. Maju Digital Nusantara',
                'alamat'             => 'Gedung Cyber 2 Lt. 18, Jl. HR Rasuna Said, Jakarta Selatan',
                'pembayaran'         => 'tempo',
                'term'               => 'tempo30',
                'catatan'            => 'Kontrak Service Maintenance SLA 4 Jam Perbaikan',
                'total_servis'       => 12,
                'total_spent'        => 18500000,
                'status'             => 'Aktif',
                'tgl_daftar'         => '20 Agu 2024',
                'jadwal_maintenance' => now()->addDays(20)->format('d M Y'),
                'units'              => [
                    [
                        'id'        => 'UNIT-10',
                        'brand'     => 'Lenovo',
                        'model'     => 'ThinkPad X1 Carbon Gen 11',
                        'sn'        => 'SN-PF4B2X9ULN',
                        'kondisi'   => 'sedang servis',
                        'tgl_masuk' => now()->format('d M Y'),
                        'status'    => 'Aktif',
                    ],
                    [
                        'id'        => 'UNIT-11',
                        'brand'     => 'Dell',
                        'model'     => 'Dell Latitude 7420 vPro',
                        'sn'        => 'SN-DL88992100',
                        'kondisi'   => 'baik',
                        'tgl_masuk' => '05 Jan 2025',
                        'status'    => 'Selesai',
                    ],
                ],
                'riwayat_servis'     => [
                    [
                        'tiket_id' => 'TK-9904',
                        'unit'     => 'ThinkPad X1 Carbon',
                        'keluhan'  => 'NVMe SSD corrupt data recovery',
                        'biaya'    => 2500000,
                        'status'   => 'Sedang Dikerjakan',
                        'tanggal'  => now()->format('d M Y'),
                    ],
                ],
            ],
            [
                'id'                 => 'CUST-C3301',
                'nama'               => 'Ibu Salsabila Ramadhani',
                'hp'                 => '+62 813-2211-5566',
                'email'              => 'salsa.ramadhani@gmail.com',
                'tipe'               => 'personal',
                'perusahaan'         => '-',
                'alamat'             => 'Komp. Bintaro Jaya Sektor 9, Tangerang Selatan',
                'pembayaran'         => 'transfer',
                'term'               => 'cash',
                'catatan'            => 'Prioritas fast track VIP',
                'total_servis'       => 2,
                'total_spent'        => 2450000,
                'status'             => 'Aktif',
                'tgl_daftar'         => '10 Mar 2025',
                'jadwal_maintenance' => null,
                'units'              => [
                    [
                        'id'        => 'UNIT-20',
                        'brand'     => 'Apple',
                        'model'     => 'iPhone 15 Pro Max 256GB',
                        'sn'        => 'SN-F4GT9X8HAB12',
                        'kondisi'   => 'sedang servis',
                        'tgl_masuk' => now()->format('d M Y'),
                        'status'    => 'Aktif',
                    ],
                ],
                'riwayat_servis'     => [
                    [
                        'tiket_id' => 'TK-9903',
                        'unit'     => 'iPhone 15 Pro Max',
                        'keluhan'  => 'Ganti tombol volume & baterai drop',
                        'biaya'    => 1750000,
                        'status'   => 'Approval WA',
                        'tanggal'  => now()->format('d M Y'),
                    ],
                ],
            ],
        ];

        $waApprovals = [
            [
                'id'             => 'TK-9903',
                'kode'           => '#TK-9903',
                'device'         => 'iPhone 15 Pro Max 256GB',
                'serial'         => 'SN-F4GT9X8HAB12',
                'nama_pelanggan' => 'Ibu Salsabila Ramadhani',
                'phone'          => '+62 813-2211-5566',
                'segment'        => 'VIP Pelanggan',
                'diagnosa'       => 'Flex volume button rusak & baterai health di bawah 80%. Butuh penggantian part original.',
                'biaya'          => 'Rp 1.750.000',
                'harga_raw'      => 1750000,
                'status'         => 'Menunggu Respon',
                'dibaca'         => true,
                'created_at'     => now()->subHours(2)->format('H:i') . ' WIB',
                'rincian'        => [
                    ['item' => 'Flex Volume Button OEM Grade A', 'harga' => 'Rp 450.000'],
                    ['item' => 'Baterai Original 4422mAh w/ BMS', 'harga' => 'Rp 950.000'],
                    ['item' => 'Jasa Pemasangan & Water Resistant Seal', 'harga' => 'Rp 350.000'],
                ],
                'estimasi_waktu' => '1 Hari Kerja',
                'tracking_url'   => 'https://track.techfix.id/TK-9903/approval',
            ],
            [
                'id'             => 'TK-9901',
                'kode'           => '#TK-9901',
                'device'         => 'MacBook Pro 14" M2',
                'serial'         => 'SN-C02XW2FMJGH5',
                'nama_pelanggan' => 'Bpk. Renaldi Firmansyah',
                'phone'          => '+62 821-5544-9988',
                'segment'        => 'Reguler',
                'diagnosa'       => 'Kabel eDP Display kendor, kalibrasi sinyal LCD dan pembersihan motherboard.',
                'biaya'          => 'Rp 850.000',
                'harga_raw'      => 850000,
                'status'         => 'Disetujui',
                'dibaca'         => true,
                'created_at'     => now()->subHours(4)->format('H:i') . ' WIB',
                'rincian'        => [
                    ['item' => 'Jasa Kalibrasi Logic Board & eDP', 'harga' => 'Rp 500.000'],
                    ['item' => 'Deep Cleaning & Thermal Repaste', 'harga' => 'Rp 350.000'],
                ],
                'estimasi_waktu' => '2 Hari Kerja',
                'tracking_url'   => 'https://track.techfix.id/TK-9901/approval',
            ],
        ];

        $waAuditLogs = [
            [
                'title'      => 'Persetujuan #TK-9901 (Bpk. Renaldi Firmansyah)',
                'desc'       => 'Customer memilih opsi: Disetujui via WhatsApp Interactive Button.',
                'time'       => now()->subHours(3)->format('H:i:s') . ' WIB',
                'ip'         => '182.253.110.42 (Jakarta Selatan)',
                'valid_hash' => 'SAH SECARA HUKUM (SHA-256 Verified)',
            ],
        ];

        // Simpan ke persistent storage
        $this->saveTechfixData('tiket_diagnosa',   $tiketDiagnosa);
        $this->saveTechfixData('tiket_approval',   $tiketApproval);
        $this->saveTechfixData('tiket_dikerjakan', $tiketDikerjakan);
        $this->saveTechfixData('tiket_qc',         $tiketQc);
        $this->saveTechfixData('stok_parts',       $stokParts);
        $this->saveTechfixData('stok_suppliers',   $supplierList);
        $this->saveTechfixData('kasir_transaksi',  $kasirTransaksi);
        $this->saveTechfixData('kasir_garansi',    $kasirGaransi);
        $this->saveTechfixData('crm_customers',    $crmCustomers);
        $this->saveTechfixData('wa_approvals',     $waApprovals);
        $this->saveTechfixData('wa_audit_logs',    $waAuditLogs);

        // Juga simpan ke session agar langsung sinkron
        session([
            'techfix_initialized'      => true,
            'techfix_tiket_diagnosa'   => $tiketDiagnosa,
            'techfix_tiket_approval'   => $tiketApproval,
            'techfix_tiket_dikerjakan' => $tiketDikerjakan,
            'techfix_tiket_qc'         => $tiketQc,
            'techfix_stok_parts'       => $stokParts,
            'techfix_stok_suppliers'   => $supplierList,
            'techfix_kasir_transaksi'  => $kasirTransaksi,
            'techfix_kasir_garansi'    => $kasirGaransi,
            'techfix_crm_customers'    => $crmCustomers,
            'techfix_wa_approvals'     => $waApprovals,
            'techfix_wa_audit_logs'    => $waAuditLogs,
        ]);

        return redirect()->route('techfix.dashboard')
            ->with('success', '✅ Data demo TechFix Pro berhasil dimuat! 5 tiket aktif (2 Diagnosa, 1 Approval, 1 Dikerjakan, 1 QC) + 6 stok part + 3 transaksi kasir + 3 pelanggan CRM + 2 tracking WA.');
    }

    /**
     * Halaman Tracking & Otomasi Approval WhatsApp
     * Data kosong (clean slate) siap diisi sendiri oleh pengguna.
     */
    public function trackingWa(Request $request)
    {
        $user = auth()->user();

        $currentBranch   = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $shiftStatus     = session('techfix_shift', 'Shift 1 (Pagi - Sore)');
        
        // Data approval list dari persistent storage, default kosong []
        $approvalList = $this->getTechfixData('wa_approvals', []);
        
        // Filter status tab
        $filter = $request->query('status', 'all');
        $filteredList = $approvalList;
        if ($filter !== 'all') {
            $filteredList = array_filter($approvalList, function ($item) use ($filter) {
                return ($item['status'] ?? '') === $filter;
            });
        }

        // Tiket yang sedang di-preview di sebelah kanan
        $selectedId = $request->query('id');
        $selectedApproval = null;
        if ($selectedId) {
            foreach ($approvalList as $a) {
                if (($a['id'] ?? '') === $selectedId) {
                    $selectedApproval = $a;
                    break;
                }
            }
        } elseif (!empty($approvalList)) {
            $selectedApproval = $approvalList[0];
        }

        // Audit logs digital approval, default kosong []
        $auditLogs = $this->getTechfixData('wa_audit_logs', []);

        // Hitung metrik dinamis berdasarkan data pengguna
        $totalMenunggu  = count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Menunggu Respon'));
        $totalDisetujui = count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Disetujui'));
        $totalDitolak   = count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Ditolak'));
        
        $totalNilai = array_sum(array_map(fn($x) => (int)($x['harga_raw'] ?? 0), $approvalList));

        $statsWa = [
            'total_menunggu' => [
                'val' => $totalMenunggu,
                'total_rp' => 'Rp ' . number_format($totalNilai, 0, ',', '.'),
                'belum_baca' => count(array_filter($approvalList, fn($x) => empty($x['dibaca']))),
            ],
            'approval_rate' => count($approvalList) > 0 ? round(($totalDisetujui / count($approvalList)) * 100, 1) . '%' : '0%',
            'approval_diterima' => $totalDisetujui,
            'estimasi_ditolak' => $totalDitolak,
        ];

        return view('techfix.tracking', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'approvalList',
            'filteredList',
            'selectedApproval',
            'auditLogs',
            'filter',
            'statsWa'
        ));
    }

    /**
     * Buat estimasi baru untuk dikirim ke WhatsApp pelanggan
     */
    public function storeEstimasiWa(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'phone'          => 'required|string',
            'device'         => 'required|string|max:255',
            'diagnosa'       => 'required|string',
            'biaya'          => 'required|numeric',
        ]);

        $approvals = $this->getTechfixData('wa_approvals', []);
        $newId = 'TK-' . (9910 + count($approvals) + 1);

        $newApproval = [
            'id'             => $newId,
            'kode'           => '#' . $newId,
            'device'         => $request->device,
            'serial'         => $request->input('serial', 'SN-' . strtoupper(substr(md5(uniqid()), 0, 8))),
            'nama_pelanggan' => $request->nama_pelanggan,
            'phone'          => $request->phone,
            'segment'        => $request->input('segment', 'Reguler'),
            'diagnosa'       => $request->diagnosa,
            'biaya'          => 'Rp ' . number_format($request->biaya, 0, ',', '.'),
            'harga_raw'      => (int) $request->biaya,
            'status'         => 'Menunggu Respon',
            'dibaca'         => false,
            'created_at'     => \Carbon\Carbon::now()->format('H:i') . ' WIB',
            'rincian'        => [
                ['item' => 'Jasa Perbaikan & Rekonstruksi', 'harga' => 'Rp ' . number_format($request->biaya * 0.6, 0, ',', '.')],
                ['item' => 'Komponen Sparepart Pengganti', 'harga' => 'Rp ' . number_format($request->biaya * 0.4, 0, ',', '.')],
            ],
            'estimasi_waktu' => $request->input('estimasi_waktu', '1 - 2 Hari Kerja'),
            'tracking_url'   => 'https://track.techfix.id/' . $newId . '/approval',
        ];

        array_unshift($approvals, $newApproval);
        $this->saveTechfixData('wa_approvals', $approvals);

        return redirect()->route('techfix.tracking', ['id' => $newId])
            ->with('success', "Estimasi WhatsApp untuk {$newId} ({$request->nama_pelanggan}) berhasil dibuat!");
    }

    /**
     * Update status persetujuan estimasi WhatsApp (Setujui / Tolak)
     */
    public function updateEstimasiStatus(Request $request, $id)
    {
        $status = $request->input('status', 'Disetujui');
        $approvals = $this->getTechfixData('wa_approvals', []);
        $auditLogs = $this->getTechfixData('wa_audit_logs', []);

        foreach ($approvals as &$item) {
            if (($item['id'] ?? '') === $id) {
                $item['status'] = $status;
                $item['dibaca'] = true;

                $auditLogs[] = [
                    'title'      => "Persetujuan #{$id} ({$item['nama_pelanggan']})",
                    'desc'       => "Customer memilih opsi: {$status} via WhatsApp Interactive Button.",
                    'time'       => \Carbon\Carbon::now()->format('H:i:s') . ' WIB',
                    'ip'         => $request->ip() . ' (Jakarta)',
                    'valid_hash' => 'SAH SECARA HUKUM',
                ];
                break;
            }
        }

        $this->saveTechfixData('wa_approvals', $approvals);
        $this->saveTechfixData('wa_audit_logs', $auditLogs);

        return redirect()->route('techfix.tracking', ['id' => $id])
            ->with('success', "Status approval tiket {$id} berhasil diperbarui menjadi '{$status}'!");
    }

    /**
     * Halaman Kasir POS & Garansi
     * Data kosong (clean slate) siap diisi sendiri oleh pengguna.
     */
    public function kasir()
    {
        $user = auth()->user();
        $currentBranch = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $shiftStatus   = session('techfix_shift', 'Shift 1 (Pagi - Sore)');

        $transaksiList = $this->getTechfixData('kasir_transaksi', []);
        $garansiList   = $this->getTechfixData('kasir_garansi', []);

        $totalOmzetRaw = array_sum(array_map(fn($t) => (int)($t['total_raw'] ?? 0), $transaksiList));
        $totalOmzet    = 'Rp ' . number_format($totalOmzetRaw, 0, ',', '.');

        $stats = [
            'total_transaksi' => [
                'val' => (string) count($transaksiList),
                'sub' => count($transaksiList) > 0 ? '+' . count($transaksiList) . ' transaksi hari ini' : 'Belum ada transaksi',
            ],
            'omzet' => [
                'val' => $totalOmzetRaw > 0 ? 'Rp ' . number_format($totalOmzetRaw, 0, ',', '.') : 'Rp 0',
                'sub' => 'Akumulasi hari ini',
            ],
            'klaim_garansi' => [
                'val' => (string) count($garansiList),
                'sub' => count($garansiList) > 0 ? count($garansiList) . ' garansi aktif' : 'Belum ada klaim',
            ],
            'siap_diambil' => [
                'val' => (string) count($this->getTechfixData('tiket_qc', [])),
                'sub' => 'Unit siap serah terima',
            ],
        ];

        return view('techfix.kasir', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'transaksiList',
            'garansiList',
            'totalOmzet',
            'stats'
        ));
    }

    /**
     * Simpan transaksi kasir POS baru
     */
    public function storeTransaksi(Request $request)
    {
        $request->validate([
            'tiket_id'      => 'required|string',
            'nama_pelanggan'=> 'required|string|max:255',
            'total_biaya'   => 'required|numeric|min:0',
        ]);

        $list = $this->getTechfixData('kasir_transaksi', []);
        $newTrx = [
            'id'            => 'TRX-' . (1001 + count($list)),
            'tiket_id'      => strtoupper($request->tiket_id),
            'nama_pelanggan'=> $request->nama_pelanggan,
            'device'        => $request->input('device', '-'),
            'jenis'         => $request->input('jenis', 'Servis'),
            'total_raw'     => (int) $request->total_biaya,
            'total'         => 'Rp ' . number_format($request->total_biaya, 0, ',', '.'),
            'metode_bayar'  => $request->input('metode_bayar', 'Tunai'),
            'catatan'       => $request->input('catatan', ''),
            'status_bayar'  => 'lunas',
            'created_at'    => \Carbon\Carbon::now()->format('H:i') . ' WIB',
        ];

        array_unshift($list, $newTrx);
        $this->saveTechfixData('kasir_transaksi', $list);

        return redirect()->route('techfix.kasir')
            ->with('success', "Transaksi {$newTrx['id']} untuk '{$request->nama_pelanggan}' berhasil disimpan & siap cetak struk!");
    }

    /**
     * Simpan klaim garansi baru
     */
    public function storeGaransi(Request $request)
    {
        $request->validate([
            'tiket_id'      => 'required|string',
            'nama_pelanggan'=> 'required|string|max:255',
            'device'        => 'required|string|max:255',
        ]);

        $list = $this->getTechfixData('kasir_garansi', []);

        $tanggalMulai  = $request->input('tanggal_mulai', \Carbon\Carbon::now()->toDateString());
        $durasi        = $request->input('durasi_garansi', '90 Hari');

        // Hitung tanggal berakhir garansi sederhana
        $mulai = \Carbon\Carbon::parse($tanggalMulai);
        if (str_contains($durasi, 'Hari')) {
            $days    = (int) $durasi;
            $expired = $mulai->addDays($days)->format('d M Y');
        } elseif (str_contains($durasi, 'Bulan')) {
            $months  = (int) $durasi;
            $expired = $mulai->addMonths($months)->format('d M Y');
        } elseif (str_contains($durasi, 'Tahun')) {
            $expired = $mulai->addYear()->format('d M Y');
        } else {
            $expired = $mulai->addDays(90)->format('d M Y');
        }

        $newGaransi = [
            'id'            => 'GRN-' . (1001 + count($list)),
            'tiket_id'      => strtoupper($request->tiket_id),
            'nama_pelanggan'=> $request->nama_pelanggan,
            'device'        => $request->device,
            'cakupan'       => $request->input('cakupan', 'Garansi jasa & sparepart'),
            'tanggal_mulai' => \Carbon\Carbon::parse($tanggalMulai)->format('d M Y'),
            'durasi'        => $durasi,
            'expired'       => $expired,
            'status'        => 'Aktif',
            'created_at'    => \Carbon\Carbon::now()->format('H:i') . ' WIB',
        ];

        array_unshift($list, $newGaransi);
        $this->saveTechfixData('kasir_garansi', $list);

        return redirect()->route('techfix.kasir')
            ->with('success', "Garansi {$newGaransi['id']} untuk '{$request->nama_pelanggan}' ({$request->device}) berhasil didaftarkan! Berlaku hingga {$expired}.");
    }

    /**
     * Reset / Kosongkan data Kasir POS & Garansi
     */
    public function resetKasir()
    {
        $this->saveTechfixData('kasir_transaksi', []);
        $this->saveTechfixData('kasir_garansi', []);

        return redirect()->route('techfix.kasir')
            ->with('success', 'Data Kasir POS & Garansi telah dikosongkan. Siap diisi mandiri.');
    }

    /**
     * Halaman Stok Sparepart & Inventaris
     * Data kosong (clean slate) siap diisi sendiri oleh pengguna.
     */
    public function stok()
    {
        $user          = auth()->user();
        $currentBranch = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $shiftStatus   = session('techfix_shift', 'Shift 1 (Pagi - Sore)');

        $partList     = $this->getTechfixData('stok_parts', []);
        $supplierList = $this->getTechfixData('stok_suppliers', []);
        $lastOpname   = $this->getTechfixData('stok_last_opname', '-');

        // Hitung stats dinamis
        $kritis   = count(array_filter($partList, fn($p) => ($p['status_stok'] ?? '') === 'kritis'));
        $menipis  = count(array_filter($partList, fn($p) => ($p['status_stok'] ?? '') === 'menipis'));
        $aman     = count(array_filter($partList, fn($p) => ($p['status_stok'] ?? '') === 'aman'));
        $valuasi  = array_sum(array_map(fn($p) => (int)($p['stok_gudang'] ?? 0) * (int)($p['harga_modal'] ?? 0), $partList));
        $terpasang = array_sum(array_map(fn($p) => (int)($p['terpasang'] ?? 0), $partList));

        $statsStok = [
            'total_sku'    => count($partList),
            'display_unit' => count($partList),
            'kritis'       => $kritis,
            'menipis'      => $menipis,
            'aman'         => $aman,
            'valuasi'      => $valuasi,
            'terpasang'    => $terpasang,
            'margin'       => '0%',
            'margin_trend' => 0,
            'po_pending'   => 0,
            'po_supplier'  => 0,
        ];

        // Kategori dinamis dari data yang ada
        $usedKats = array_unique(array_column($partList, 'kategori'));
        $kategoris = [['label' => 'Semua Kategori (' . count($partList) . ')', 'slug' => 'semua', 'count' => null]];
        foreach ($usedKats as $kat) {
            if ($kat) {
                $slug = strtolower(str_replace([' ', '&'], ['-', ''], $kat));
                $cnt  = count(array_filter($partList, fn($p) => ($p['kategori'] ?? '') === $kat));
                $kategoris[] = ['label' => $kat, 'slug' => $slug, 'count' => $cnt];
            }
        }

        return view('techfix.stok', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'partList',
            'supplierList',
            'statsStok',
            'kategoris',
            'lastOpname'
        ));
    }

    /**
     * Simpan sparepart / komponen baru ke inventaris
     */
    public function storePartStok(Request $request)
    {
        $request->validate([
            'part_number' => 'required|string|max:100',
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|string',
            'stok_gudang' => 'required|integer|min:0',
        ]);

        $parts = $this->getTechfixData('stok_parts', []);

        $stokGudang = (int) $request->stok_gudang;
        $stokMin    = (int) $request->input('stok_min', 1);
        $statusStok = $stokGudang === 0 ? 'kritis' : ($stokGudang <= $stokMin ? 'menipis' : 'aman');

        $kategoris = [
            'SSD & Storage'   => 'fa-solid fa-hard-drive',
            'RAM Memory'      => 'fa-solid fa-memory',
            'Baterai Laptop'  => 'fa-solid fa-battery-half',
            'Fan & Heatsink'  => 'fa-solid fa-fan',
            'Thermal Material'=> 'fa-solid fa-temperature-high',
            'Layar & LCD'     => 'fa-solid fa-desktop',
            'Keyboard & LCD'  => 'fa-solid fa-keyboard',
            'IC & Komponen'   => 'fa-solid fa-microchip',
            'Kabel & Konektor'=> 'fa-solid fa-plug',
        ];
        $icon = $kategoris[$request->kategori] ?? 'fa-solid fa-box';
        $kategorisSlug = strtolower(str_replace([' ', '&'], ['-', ''], $request->kategori));

        $newPart = [
            'id'            => 'PART-' . (1001 + count($parts)),
            'part_number'   => strtoupper($request->part_number),
            'nama'          => $request->nama,
            'deskripsi'     => $request->input('deskripsi', ''),
            'kategori'      => $request->kategori,
            'kategori_slug' => $kategorisSlug,
            'kompatibel'    => $request->input('kompatibel', 'Universal'),
            'stok_gudang'   => $stokGudang,
            'stok_toko'     => (int) $request->input('stok_toko', 0),
            'stok_min'      => $stokMin,
            'harga_modal'   => (int) $request->input('harga_modal', 0),
            'harga_jual'    => (int) $request->input('harga_jual', 0),
            'supplier'      => $request->input('supplier', '-'),
            'status_stok'   => $statusStok,
            'icon'          => $icon,
            'terpasang'     => 0,
            'created_at'    => \Carbon\Carbon::now()->format('d M Y H:i'),
        ];

        array_unshift($parts, $newPart);
        $this->saveTechfixData('stok_parts', $parts);

        return redirect()->route('techfix.stok')
            ->with('success', "Part {$newPart['part_number']} — '{$request->nama}' berhasil ditambahkan ke inventaris!");
    }

    /**
     * Reset / Kosongkan data Stok Sparepart
     */
    public function resetStok()
    {
        $this->saveTechfixData('stok_parts', []);
        $this->saveTechfixData('stok_suppliers', []);

        return redirect()->route('techfix.stok')
            ->with('success', 'Data Stok Sparepart & Inventaris telah dikosongkan. Siap diisi mandiri.');
    }

    /**
     * Halaman CRM Pelanggan & Riwayat Siklus Unit Servis
     * Data kosong (clean slate) — siap diisi sendiri oleh pengguna.
     */
    public function crm(Request $request)
    {
        $user          = auth()->user();
        $currentBranch = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $shiftStatus   = session('techfix_shift', 'Shift 1 (Pagi - Sore)');

        $customers = $this->getTechfixData('crm_customers', []);

        $selectedId = $request->query('customer_id');
        $selectedCustomer = null;
        if (!empty($customers)) {
            if ($selectedId) {
                $selectedCustomer = collect($customers)->firstWhere('id', $selectedId);
            }
            if (!$selectedCustomer) {
                $selectedCustomer = $customers[0];
            }
        }

        // Hitung stats
        $totalCustomers = count($customers);
        $totalUnits     = 0;
        $repeatCount    = 0;
        $totalLtv       = 0;
        $totalJadwal    = 0;

        foreach ($customers as $c) {
            $unitCount   = count($c['units'] ?? []);
            $totalUnits += $unitCount;
            if (($c['total_servis'] ?? 0) > 1) {
                $repeatCount++;
            }
            $totalLtv += (int)($c['total_spent'] ?? 0);
            if (!empty($c['jadwal_maintenance'])) {
                $totalJadwal++;
            }
        }

        $repeatRate = $totalCustomers > 0 ? round(($repeatCount / $totalCustomers) * 100) : 0;
        $avgLtv     = $totalCustomers > 0 ? 'Rp ' . number_format($totalLtv / $totalCustomers, 0, ',', '.') : 'Rp 0';

        $statsCrm = [
            'total_pelanggan'    => $totalCustomers,
            'unit_ditangani'     => $totalUnits,
            'repeat_rate'        => $repeatRate,
            'avg_ltv'            => $avgLtv,
            'jadwal_maintenance' => $totalJadwal,
        ];

        return view('techfix.crm', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'customers',
            'selectedCustomer',
            'statsCrm'
        ));
    }

    /**
     * Simpan Pelanggan Baru ke CRM
     */
    public function storeCustomer(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'hp'   => 'required|string|max:30',
        ]);

        $customers = $this->getTechfixData('crm_customers', []);

        $newId = 'CUST-' . strtoupper(substr(md5(uniqid()), 0, 5));

        $initialUnits = [];
        if (!empty($request->brand) || !empty($request->model)) {
            $initialUnits[] = [
                'id'         => 'UNIT-' . strtoupper(substr(md5(uniqid()), 0, 4)),
                'brand'      => $request->brand ?? 'Generic',
                'model'      => $request->model ?? 'Standard Unit',
                'sn'         => $request->sn ?: ('SN-' . strtoupper(substr(md5(uniqid()), 0, 8))),
                'kondisi'    => $request->kondisi ?? 'baik',
                'tgl_masuk'  => now()->format('d M Y'),
                'status'     => 'Aktif',
            ];
        }

        $newCustomer = [
            'id'                 => $newId,
            'nama'               => $request->nama,
            'hp'                 => $request->hp,
            'email'              => $request->email ?: '-',
            'tipe'               => $request->tipe ?: 'personal',
            'perusahaan'         => $request->perusahaan ?: '-',
            'alamat'             => $request->alamat ?: '-',
            'pembayaran'         => $request->pembayaran ?: 'cash',
            'term'               => $request->term ?: 'cash',
            'catatan'            => $request->catatan ?: '-',
            'total_servis'       => count($initialUnits) > 0 ? 1 : 0,
            'total_spent'        => 0,
            'status'             => 'Aktif',
            'tgl_daftar'         => now()->format('d M Y'),
            'jadwal_maintenance' => $request->tipe === 'korporat' ? now()->addMonths(3)->format('d M Y') : null,
            'units'              => $initialUnits,
            'riwayat_servis'     => count($initialUnits) > 0 ? [
                [
                    'tiket_id'   => 'TIX-' . rand(1000, 9999),
                    'unit'       => ($request->brand ?? '') . ' ' . ($request->model ?? 'Unit Pertama'),
                    'keluhan'    => 'Pendaftaran awal unit ke sistem CRM',
                    'biaya'      => 0,
                    'status'     => 'Terdaftar',
                    'tanggal'    => now()->format('d M Y'),
                ]
            ] : [],
        ];

        array_unshift($customers, $newCustomer);
        $this->saveTechfixData('crm_customers', $customers);

        return redirect()->route('techfix.crm', ['customer_id' => $newId])
            ->with('success', "Pelanggan {$newCustomer['nama']} ({$newId}) berhasil didaftarkan ke sistem CRM!");
    }

    /**
     * Tambah Unit ke Pelanggan yang Dipilih
     */
    public function storeUnit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'brand'       => 'required|string|max:60',
            'model'       => 'required|string|max:80',
        ]);

        $customers = $this->getTechfixData('crm_customers', []);
        $found = false;

        foreach ($customers as &$c) {
            if ($c['id'] === $request->customer_id) {
                $newUnit = [
                    'id'         => 'UNIT-' . strtoupper(substr(md5(uniqid()), 0, 4)),
                    'brand'      => $request->brand,
                    'model'      => $request->model,
                    'sn'         => $request->sn ?: ('SN-' . strtoupper(substr(md5(uniqid()), 0, 8))),
                    'kondisi'    => $request->kondisi ?? 'baik',
                    'tgl_masuk'  => now()->format('d M Y'),
                    'status'     => 'Aktif',
                ];
                $c['units'][] = $newUnit;
                $c['total_servis'] = ($c['total_servis'] ?? 0) + 1;
                $c['riwayat_servis'][] = [
                    'tiket_id' => 'TIX-' . rand(1000, 9999),
                    'unit'     => $request->brand . ' ' . $request->model,
                    'keluhan'  => 'Registrasi penambahan unit baru',
                    'biaya'    => 0,
                    'status'   => 'Terdaftar',
                    'tanggal'  => now()->format('d M Y'),
                ];
                $found = true;
                break;
            }
        }

        if ($found) {
            $this->saveTechfixData('crm_customers', $customers);
            return redirect()->route('techfix.crm', ['customer_id' => $request->customer_id])
                ->with('success', "Unit baru {$request->brand} {$request->model} berhasil ditambahkan ke armada pelanggan!");
        }

        return redirect()->route('techfix.crm')->with('error', 'Pelanggan tidak ditemukan.');
    }

    /**
     * Reset / Kosongkan data CRM & Riwayat Unit
     */
    public function resetCrm()
    {
        $this->saveTechfixData('crm_customers', []);

        return redirect()->route('techfix.crm')
            ->with('success', 'Data CRM Pelanggan & Riwayat Unit telah dikosongkan. Siap diisi mandiri.');
    }

    /**
     * Halaman Laporan Keuangan, Omzet Servis & Analitik Laba
     * Data kosong (clean slate) — siap diisi sendiri oleh pengguna.
     */
    public function laporan(Request $request)
    {
        $user          = auth()->user();
        $currentBranch = session('techfix_branch', 'Cabang Mangga Dua Mall Lt. 3');
        $shiftStatus   = session('techfix_shift', 'Shift 1 (Pagi - Sore)');
        $tutupBukuAt   = session('techfix_laporan_tutup_buku', null);

        $transaksiList = session('techfix_laporan_transaksi', []);

        // Hitung Keuangan Dinamis
        $grossRevenue  = 0;
        $laborRevenue  = 0;
        $partsRevenue  = 0;
        $partsHpp      = 0;
        $totalOpEx     = 0;
        $unitReparasi  = 0;

        $kasSinkron    = 0;
        $piutangB2B    = 0;

        $kanalBayar = [
            'qris'     => 0,
            'transfer' => 0,
            'edc'      => 0,
            'tunai'    => 0,
        ];

        // Teknisi Komisi Pool
        $teknisiList = [
            'hendra' => [
                'nama'       => 'Hendra W.',
                'title'      => 'Senior Microsolder Specialist',
                'retur'      => '0%',
                'rate'       => 0.30,
                'tiket'      => 0,
                'omzet_jasa' => 0,
                'komisi'     => 0,
            ],
            'faisal' => [
                'nama'       => 'Faisal',
                'title'      => 'Hardware & Motherboard Tech',
                'retur'      => '1.2%',
                'rate'       => 0.30,
                'tiket'      => 0,
                'omzet_jasa' => 0,
                'komisi'     => 0,
            ],
            'budi'   => [
                'nama'       => 'Budi Santoso',
                'title'      => 'Display & Thermal Tech',
                'retur'      => '0.5%',
                'rate'       => 0.30,
                'tiket'      => 0,
                'omzet_jasa' => 0,
                'komisi'     => 0,
            ],
        ];

        // Kategori Layanan Map
        $kategoriMap = [
            'microsolder' => [
                'nama'     => 'Microsolder & Reballing Motherboard',
                'sub'      => 'IC Power, Short VCore, Mosfet replacement',
                'tiket'    => 0,
                'omzet'    => 0,
                'hpp'      => 0,
            ],
            'lcd' => [
                'nama'     => 'Pergantian LCD & Panel Gaming',
                'sub'      => '144Hz FHD, IPS 2K, Apple Retina Assemblies',
                'tiket'    => 0,
                'omzet'    => 0,
                'hpp'      => 0,
            ],
            'thermal' => [
                'nama'     => 'Thermal Overhaul, Repaste & Fan',
                'sub'      => 'Liquid Metal, Arctic MX-6, Ultrasonic Clean',
                'tiket'    => 0,
                'omzet'    => 0,
                'hpp'      => 0,
            ],
            'battery' => [
                'nama'     => 'Baterai, Type-C Jack & Keyboard',
                'sub'      => 'Penggantian modul part OEM & soldering port',
                'tiket'    => 0,
                'omzet'    => 0,
                'hpp'      => 0,
            ],
            'upgrade' => [
                'nama'     => 'Upgrade SSD NVMe & System Clone',
                'sub'      => 'Gen4 M.2 1TB/2TB + Migrasi OS & Lisensi',
                'tiket'    => 0,
                'omzet'    => 0,
                'hpp'      => 0,
            ],
        ];

        // Loop transaksi jika ada
        foreach ($transaksiList as $t) {
            $nominal = (int)($t['nominal'] ?? 0);
            $hpp     = (int)($t['hpp'] ?? 0);
            $tipe    = $t['tipe'] ?? 'jasa';

            if ($tipe === 'jasa') {
                $grossRevenue += $nominal;
                $laborRevenue += $nominal;
                $unitReparasi++;

                // Assign to technician
                $tekKey = strtolower($t['teknisi_key'] ?? '');
                if (isset($teknisiList[$tekKey])) {
                    $teknisiList[$tekKey]['tiket']++;
                    $teknisiList[$tekKey]['omzet_jasa'] += $nominal;
                    $teknisiList[$tekKey]['komisi'] += ($nominal * $teknisiList[$tekKey]['rate']);
                }
            } elseif ($tipe === 'part') {
                $grossRevenue += $nominal;
                $partsRevenue += $nominal;
                $partsHpp     += $hpp;
            } elseif ($tipe === 'pengeluaran') {
                $totalOpEx += $nominal;
            }

            // Kategori
            $katKey = $t['kategori_key'] ?? '';
            if (isset($kategoriMap[$katKey])) {
                $kategoriMap[$katKey]['tiket']++;
                $kategoriMap[$katKey]['omzet'] += $nominal;
                $kategoriMap[$katKey]['hpp']   += $hpp;
            }

            // Kanal Bayar
            $kanal = $t['kanal_bayar'] ?? 'tunai';
            if ($kanal === 'tempo_b2b') {
                $piutangB2B += $nominal;
            } else {
                $kasSinkron += $nominal;
                if (isset($kanalBayar[$kanal])) {
                    $kanalBayar[$kanal] += $nominal;
                }
            }
        }

        $partsGrossProfit = max(0, $partsRevenue - $partsHpp);
        $netProfit = $grossRevenue - $partsHpp - $totalOpEx;
        $netMargin = $grossRevenue > 0 ? round(($netProfit / $grossRevenue) * 100, 1) : 0;
        $laborRerata = $unitReparasi > 0 ? round($laborRevenue / $unitReparasi) : 0;

        // Persentase kanal bayar
        $totalKas = array_sum($kanalBayar);
        $persenKanal = [
            'qris'     => $totalKas > 0 ? round(($kanalBayar['qris'] / $totalKas) * 100, 1) : 0,
            'transfer' => $totalKas > 0 ? round(($kanalBayar['transfer'] / $totalKas) * 100, 1) : 0,
            'edc'      => $totalKas > 0 ? round(($kanalBayar['edc'] / $totalKas) * 100, 1) : 0,
            'tunai'    => $totalKas > 0 ? round(($kanalBayar['tunai'] / $totalKas) * 100, 1) : 0,
        ];

        // Pajak PPh Final UMKM 0.5%
        $pphFinal = round($grossRevenue * 0.005);

        // Chart 28 hari kosong (atau terisi)
        $chartDays = [];
        for ($i = 1; $i <= 28; $i++) {
            $dayNum = str_pad($i, 2, '0', STR_PAD_LEFT);
            $jasaVal = 0;
            $partVal = 0;
            foreach ($transaksiList as $t) {
                if (($t['hari'] ?? '') == $i) {
                    if (($t['tipe'] ?? '') === 'jasa') $jasaVal += (int)$t['nominal'];
                    if (($t['tipe'] ?? '') === 'part') $partVal += (int)$t['nominal'];
                }
            }
            $chartDays[] = [
                'day'   => $dayNum,
                'jasa'  => $jasaVal,
                'part'  => $partVal,
                'total' => $jasaVal + $partVal,
            ];
        }

        $statsLaporan = [
            'gross_revenue'      => $grossRevenue,
            'net_profit'         => $netProfit,
            'net_margin'         => $netMargin,
            'labor_revenue'      => $laborRevenue,
            'unit_reparasi'      => $unitReparasi,
            'labor_rerata'       => $laborRerata,
            'parts_revenue'      => $partsRevenue,
            'parts_hpp'          => $partsHpp,
            'parts_gross_profit' => $partsGrossProfit,
            'kas_sinkron'        => $kasSinkron,
            'piutang_b2b'        => $piutangB2B,
            'pph_final'          => $pphFinal,
            'total_transaksi'    => count($transaksiList),
            'tutup_buku_at'      => $tutupBukuAt,
        ];

        return view('techfix.laporan', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'statsLaporan',
            'teknisiList',
            'kategoriMap',
            'kanalBayar',
            'persenKanal',
            'chartDays',
            'transaksiList'
        ));
    }

    /**
     * Catat Transaksi Finansial / Entri Pembukuan Baru
     */
    public function storeLaporanTransaksi(Request $request)
    {
        $request->validate([
            'tipe'        => 'required|in:jasa,part,pengeluaran',
            'nominal'     => 'required|numeric|min:0',
            'keterangan'  => 'required|string|max:150',
        ]);

        $transaksiList = session('techfix_laporan_transaksi', []);

        $newTransaksi = [
            'id'           => 'FIN-' . strtoupper(substr(md5(uniqid()), 0, 5)),
            'tanggal'      => now()->format('d M Y'),
            'hari'         => (int)now()->format('d'),
            'tipe'         => $request->tipe,
            'nominal'      => (int)$request->nominal,
            'hpp'          => (int)($request->hpp ?? 0),
            'kategori_key' => $request->kategori_key ?: 'microsolder',
            'teknisi_key'  => $request->teknisi_key ?: 'hendra',
            'kanal_bayar'  => $request->kanal_bayar ?: 'tunai',
            'keterangan'   => $request->keterangan,
        ];

        array_unshift($transaksiList, $newTransaksi);
        session(['techfix_laporan_transaksi' => $transaksiList]);

        return redirect()->route('techfix.laporan')
            ->with('success', "Transaksi finansial '{$newTransaksi['keterangan']}' (Rp " . number_format($newTransaksi['nominal'], 0, ',', '.') . ") berhasil dicatat!");
    }

    /**
     * Tutup Buku & Rekonsiliasi Kasir
     */
    public function tutupBuku(Request $request)
    {
        session(['techfix_laporan_tutup_buku' => now()->format('d M Y - H:i') . ' WIB']);

        return redirect()->route('techfix.laporan')
            ->with('success', 'Buku kas periode ini telah berhasil ditutup dan direkonsiliasi.');
    }

    /**
     * Kosongkan Data Laporan Keuangan
     */
    public function resetLaporan()
    {
        session([
            'techfix_laporan_transaksi'  => [],
            'techfix_laporan_tutup_buku' => null,
        ]);

        return redirect()->route('techfix.laporan')
            ->with('success', 'Data Laporan Keuangan & Analitik Laba telah dikosongkan. Siap diisi mandiri.');
    }

    /**
     * Halaman Laporan & Audit Log Pengaturan Sistem
     * Data kosong (clean slate) — siap diisi sendiri oleh pengguna.
     */
    public function pengaturan(Request $request)
    {
        $user          = auth()->user();
        $currentBranch = session('techfix_branch', 'Mangga Dua Mall (Pusat)');
        $shiftStatus   = session('techfix_shift', 'Shift 1 (Pagi - Sore)');

        $logs = session('techfix_settings_logs', []);

        $filterCat   = $request->query('kategori', 'all');
        $filterLevel = $request->query('level', 'ALL');

        // Filter data jika ada
        $filteredLogs = $logs;
        if ($filterCat !== 'all') {
            $filteredLogs = array_filter($filteredLogs, function($l) use ($filterCat) {
                return ($l['kategori_key'] ?? '') === $filterCat;
            });
        }
        if ($filterLevel !== 'ALL') {
            $filteredLogs = array_filter($filteredLogs, function($l) use ($filterLevel) {
                return strtoupper($l['level'] ?? 'INFO') === $filterLevel;
            });
        }

        $totalLogs    = count($logs);
        $totalRevisi  = count(array_filter($logs, fn($l) => ($l['kategori_key'] ?? '') !== 'auth'));
        $waDelivery   = count(array_filter($logs, fn($l) => ($l['kategori_key'] ?? '') === 'whatsapp'));
        $totalBackup  = count(array_filter($logs, fn($l) => ($l['kategori_key'] ?? '') === 'backup'));

        $statsPengaturan = [
            'total_logs'    => $totalLogs,
            'total_revisi'  => $totalRevisi,
            'wa_pesan'      => $waDelivery,
            'total_backup'  => $totalBackup,
        ];

        return view('techfix.pengaturan', compact(
            'user',
            'currentBranch',
            'shiftStatus',
            'logs',
            'filteredLogs',
            'statsPengaturan',
            'filterCat',
            'filterLevel'
        ));
    }

    /**
     * Simpan Entri Audit Log / Perubahan Konfigurasi Baru
     */
    public function storePengaturanLog(Request $request)
    {
        $request->validate([
            'aktor'    => 'required|string|max:80',
            'modul'    => 'required|string|max:80',
            'tindakan' => 'required|string|max:200',
        ]);

        $logs = session('techfix_settings_logs', []);

        $newLog = [
            'id'           => 'LOG-' . strtoupper(substr(md5(uniqid()), 0, 6)),
            'waktu'        => now()->format('d M Y'),
            'jam'          => now()->format('H:i:s') . ' WIB',
            'aktor'        => $request->aktor,
            'role'         => $request->role ?: 'Chief Admin',
            'modul'        => $request->modul,
            'kategori_key' => $request->kategori_key ?: 'kebijakan',
            'tindakan'     => $request->tindakan,
            'level'        => strtoupper($request->level ?: 'INFO'),
        ];

        array_unshift($logs, $newLog);
        session(['techfix_settings_logs' => $logs]);

        return redirect()->route('techfix.pengaturan')
            ->with('success', "Aktivitas konfigurasi '{$newLog['tindakan']}' berhasil dicatat ke Audit Log!");
    }

    /**
     * Kosongkan Data Audit Log Pengaturan Sistem
     */
    public function resetPengaturan()
    {
        session(['techfix_settings_logs' => []]);

        return redirect()->route('techfix.pengaturan')
            ->with('success', 'Data Audit Log Pengaturan Sistem telah dikosongkan. Siap diisi mandiri.');
    }
}
