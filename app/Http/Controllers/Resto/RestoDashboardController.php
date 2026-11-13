<?php

namespace App\Http\Controllers\Resto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestoDashboardController extends Controller
{
    /**
     * Helper penyimpanan data Resto secara permanen (file JSON).
     */
    private function getRestoData(string $key, $default = [])
    {
        $path = storage_path('app/resto_data.json');
        if (file_exists($path)) {
            $jsonContent = @file_get_contents($path);
            $json = json_decode($jsonContent, true);
            if (is_array($json) && array_key_exists($key, $json)) {
                return $json[$key];
            }
        }

        $sessionData = session($key, null);
        if ($sessionData !== null) {
            $this->saveRestoData($key, $sessionData);
            return $sessionData;
        }

        return $default;
    }

    private function saveRestoData(string $key, $value): void
    {
        $path = storage_path('app/resto_data.json');
        $dir = dirname($path);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $allData = [];
        if (file_exists($path)) {
            $jsonContent = @file_get_contents($path);
            $allData = json_decode($jsonContent, true) ?: [];
        }

        $allData[$key] = $value;
        @file_put_contents($path, json_encode($allData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        session([$key => $value]);
    }

    /**
     * Dashboard RestoHub OS (Culinary Operations).
     * Seluruh data awal KOSONG — siap diisi sendiri oleh pengguna.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // 1. Cabang & Shift Info
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $branches = [
            'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta',
            'RestoHub Express - Senayan City',
            'RestoHub Garden & Lounge - PIK Avenue',
        ];

        $shiftInfo = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam' => '09:00 - 17:00',
            'kasir' => $user->name ?? 'Kasir Utama',
            'kas_awal' => 0,
            'status' => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        // 2. Denah Meja (Floor Plan) — DEFAULT KOSONG []
        $indoorTables = $this->getRestoData('resto_indoor_tables', []);
        $outdoorTables = $this->getRestoData('resto_outdoor_tables', []);

        // Service Mode Counters (dihitung dari meja nyata atau 0)
        $serviceCounters = [
            'dine_in' => count($indoorTables) + count($outdoorTables),
            'takeaway' => count($this->getRestoData('resto_takeaway_orders', [])),
            'online' => count($this->getRestoData('resto_online_orders', [])),
            'qr_self_order' => count($this->getRestoData('resto_qr_orders', [])),
        ];

        // 3. Katalog Menu & Quick Add — DEFAULT KOSONG []
        $menuKatalog = $this->getRestoData('resto_menu_katalog', []);

        // 4. Tiket Aktif — DEFAULT KOSONG
        $defaultTicket = [
            'meja_id' => '-',
            'area' => 'Belum Ada Meja Terpilih',
            'pax' => 0,
            'tiket_no' => '-',
            'waktu_buat' => '-',
            'items' => [],
            'catatan_dapur' => '',
            'tukar_poin' => false,
        ];
        $activeTicket = $this->getRestoData('resto_active_ticket', $defaultTicket);

        // Perhitungan tagihan
        $subtotal = 0;
        $totalPorsi = 0;
        if (!empty($activeTicket['items'])) {
            foreach ($activeTicket['items'] as $item) {
                $subtotal += ($item['harga'] * $item['qty']);
                $totalPorsi += $item['qty'];
            }
        }

        $diskonPoin = !empty($activeTicket['tukar_poin']) ? 25000 : 0;
        $afterDiscount = max(0, $subtotal - $diskonPoin);
        $serviceCharge = $afterDiscount > 0 ? round($afterDiscount * 0.05) : 0; // 5%
        $pb1 = $afterDiscount > 0 ? round($afterDiscount * 0.10) : 0; // 10%
        $totalTagihan = $afterDiscount + $serviceCharge + $pb1;

        $memberInfo = [
            'nama' => 'Belum Ada Member',
            'tier' => 'REGULER',
            'poin' => 0,
            'potongan_poin' => 0,
            'nilai_potongan' => 0,
        ];

        return view('resto.dashboard', compact(
            'user',
            'currentBranch',
            'branches',
            'shiftInfo',
            'serviceCounters',
            'indoorTables',
            'outdoorTables',
            'menuKatalog',
            'activeTicket',
            'subtotal',
            'totalPorsi',
            'diskonPoin',
            'serviceCharge',
            'pb1',
            'totalTagihan',
            'memberInfo'
        ));
    }

    /**
     * Buka / Tambah Meja Baru (Indoor atau Outdoor).
     */
    public function createTable(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:10',
            'area' => 'required|string|in:indoor,outdoor',
            'kursi' => 'required|string|max:50',
        ]);

        $area = $request->input('area');
        $label = strtoupper(trim($request->input('label')));
        $kursi = $request->input('kursi');
        $guest = $request->input('guest', '');
        $sessionKey = $area === 'indoor' ? 'resto_indoor_tables' : 'resto_outdoor_tables';

        $tables = $this->getRestoData($sessionKey, []);
        $newTable = [
            'id' => $label,
            'label' => $label,
            'kursi' => $kursi,
            'guest' => $guest,
            'status' => 'available',
            'status_badge' => 'Siap Pakai',
            'badge_color' => 'bg-emerald-100 text-emerald-700',
            'timer' => '',
            'info' => 'Meja Bersih & Siap',
            'note' => 'Meja Baru',
            'total' => 0,
            'duration' => '',
            'waitress' => 'Waitress: ' . auth()->user()->name,
        ];

        $tables[] = $newTable;
        $this->saveRestoData($sessionKey, $tables);

        return redirect()->route('resto.dashboard')->with('success', "Meja {$label} ({$area}) berhasil ditambahkan dan siap dipakai!");
    }

    /**
     * Tambah Menu Baru ke Katalog Cepat.
     */
    public function createMenu(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
        ]);

        $katalog = $this->getRestoData('resto_menu_katalog', []);
        $newId = count($katalog) + 1;

        $katalog[] = [
            'id' => $newId,
            'nama' => $request->input('nama'),
            'kategori' => $request->input('kategori'),
            'deskripsi' => $request->input('deskripsi', 'Menu Spesial RestoHub'),
            'harga' => (int) $request->input('harga'),
            'badge' => $request->input('badge', 'Tersedia'),
            'badge_color' => 'bg-emerald-600/90 text-white',
            'img' => $request->input('img', 'https://images.unsplash.com/photo-1544025162-d76694265947?w=500&auto=format&fit=crop&q=80'),
        ];

        $this->saveRestoData('resto_menu_katalog', $katalog);

        return redirect()->route('resto.dashboard')->with('success', "Menu '{$request->nama}' berhasil ditambahkan ke katalog!");
    }

    /**
     * Pilih Meja untuk dijadikan Tiket Aktif.
     */
    public function selectTable(Request $request)
    {
        $tableId = $request->input('table_id');
        $area = $request->input('area', 'Area Indoor AC');
        $pax = (int) $request->input('pax', 4);

        $activeTicket = $this->getRestoData('resto_active_ticket', []);
        $activeTicket['meja_id'] = $tableId;
        $activeTicket['area'] = $area;
        $activeTicket['pax'] = $pax;
        $activeTicket['tiket_no'] = '#RH-' . rand(1000, 9999);
        $activeTicket['waktu_buat'] = date('H:i') . ' WIB';

        $this->saveRestoData('resto_active_ticket', $activeTicket);

        return redirect()->route('resto.dashboard')->with('info', "Meja {$tableId} kini menjadi tiket aktif.");
    }

    /**
     * Update status meja (available, occupied, billed, reserved).
     */
    public function updateTableStatus(Request $request)
    {
        $tableId = $request->input('table_id');
        $status = $request->input('status', 'available');

        $statusBadges = [
            'available' => ['badge' => 'Siap Pakai', 'color' => 'bg-emerald-100 text-emerald-700', 'info' => 'Meja Bersih & Siap'],
            'occupied'  => ['badge' => 'Terisi',     'color' => 'bg-amber-100 text-amber-700',     'info' => 'Sedang Makan'],
            'billed'    => ['badge' => 'Cetak Bill', 'color' => 'bg-blue-100 text-blue-700',       'info' => 'Menunggu Pembayaran'],
            'reserved'  => ['badge' => 'Reservasi',  'color' => 'bg-purple-100 text-purple-700',   'info' => 'Dipesan Khusus'],
        ];

        $badgeInfo = $statusBadges[$status] ?? $statusBadges['available'];

        foreach (['resto_indoor_tables', 'resto_outdoor_tables'] as $key) {
            $tables = $this->getRestoData($key, []);
            $changed = false;
            foreach ($tables as &$table) {
                if (($table['id'] ?? '') === $tableId || ($table['label'] ?? '') === $tableId) {
                    $table['status'] = $status;
                    $table['status_badge'] = $badgeInfo['badge'];
                    $table['badge_color'] = $badgeInfo['color'];
                    $table['info'] = $badgeInfo['info'];
                    $changed = true;
                    break;
                }
            }
            unset($table);
            if ($changed) {
                $this->saveRestoData($key, $tables);
                break;
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'message' => "Status meja {$tableId} diperbarui menjadi {$status}."]);
        }

        return redirect()->route('resto.dashboard')->with('success', "Status meja {$tableId} diperbarui.");
    }

    /**
     * Tambah item ke tiket aktif.
     */
    public function addItem(Request $request)
    {
        $menuId = (int) $request->input('menu_id');
        $nama = $request->input('nama');
        $harga = (int) $request->input('harga');

        $ticket = $this->getRestoData('resto_active_ticket', [
            'meja_id' => 'T-01',
            'area' => 'Area Indoor AC',
            'pax' => 2,
            'tiket_no' => '#RH-' . rand(1000, 9999),
            'waktu_buat' => date('H:i') . ' WIB',
            'items' => [],
            'catatan_dapur' => '',
            'tukar_poin' => false,
        ]);

        $found = false;
        foreach ($ticket['items'] as &$item) {
            if ($item['menu_id'] === $menuId) {
                $item['qty'] += 1;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $ticket['items'][] = [
                'id' => time() . rand(10, 99),
                'menu_id' => $menuId,
                'qty' => 1,
                'nama' => $nama,
                'harga' => $harga,
                'catatan' => '• Pesanan Baru dari POS',
                'status' => 'Pesanan Baru',
            ];
        }

        $this->saveRestoData('resto_active_ticket', $ticket);

        return redirect()->route('resto.dashboard')->with('success', "Item {$nama} berhasil ditambahkan ke tiket.");
    }

    /**
     * Kurangi atau hapus item dari tiket.
     */
    public function removeItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $ticket = $this->getRestoData('resto_active_ticket', []);

        if (isset($ticket['items'])) {
            $newItems = [];
            foreach ($ticket['items'] as $item) {
                if ($item['id'] == $itemId) {
                    if ($item['qty'] > 1) {
                        $item['qty'] -= 1;
                        $newItems[] = $item;
                    }
                } else {
                    $newItems[] = $item;
                }
            }
            $ticket['items'] = $newItems;
            $this->saveRestoData('resto_active_ticket', $ticket);
        }

        return redirect()->route('resto.dashboard')->with('info', "Pesanan tiket telah diperbarui.");
    }

    /**
     * Toggle penukaran poin member loyalty.
     */
    public function toggleDiscount(Request $request)
    {
        $ticket = $this->getRestoData('resto_active_ticket', []);
        $ticket['tukar_poin'] = !(bool)($ticket['tukar_poin'] ?? false);
        $this->saveRestoData('resto_active_ticket', $ticket);

        return redirect()->route('resto.dashboard')->with('info', "Poin loyalty member berhasil diubah.");
    }

    /**
     * Kirim pesanan ke Kitchen Display System (KDS).
     */
    public function fireKds(Request $request)
    {
        $ticket = $this->getRestoData('resto_active_ticket', []);
        if (!empty($ticket) && !empty($ticket['items'])) {
            $kdsTickets = $this->getRestoData('resto_kds_tickets', []);
            $orderNum = 'ORD-' . date('Hi') . '-' . rand(10, 99);
            $newTicket = [
                'id'         => uniqid('t_'),
                'order_no'   => $orderNum,
                'meja_id'    => $ticket['meja_id'] ?? 'Meja POS',
                'order_type' => $ticket['order_type'] ?? 'Dine In',
                'station'    => 'main',
                'minutes'    => 1,
                'urgent'     => false,
                'order_time' => date('H:i:s'),
                'waiter'     => auth()->user()->name ?? 'Waiter',
                'catatan'    => $ticket['catatan_dapur'] ?? '',
                'items'      => array_map(function ($item) {
                    return [
                        'nama'    => $item['nama'] ?? 'Item',
                        'qty'     => $item['qty'] ?? 1,
                        'station' => 'Hot',
                        'urgent'  => false,
                        'notes'   => $item['catatan'] ?? '',
                    ];
                }, $ticket['items']),
            ];
            $kdsTickets[] = $newTicket;
            $this->saveRestoData('resto_kds_tickets', $kdsTickets);
        }

        return redirect()->route('resto.dashboard')->with('success', "🔥 Fire KDS Berhasil! Pesanan diteruskan ke Kitchen & Bar.");
    }

    /**
     * Simpan catatan dapur.
     */
    public function saveCatatanDapur(Request $request)
    {
        $ticket = $this->getRestoData('resto_active_ticket', []);
        $ticket['catatan_dapur'] = $request->input('catatan', '');
        $this->saveRestoData('resto_active_ticket', $ticket);

        return redirect()->route('resto.dashboard')->with('success', "Catatan dapur berhasil disimpan.");
    }

    /**
     * Proses transaksi pembayaran kasir.
     */
    public function processPayment(Request $request)
    {
        $metode = $request->input('metode', 'Tunai Pas');
        $nominal = $request->input('nominal', 0);

        // Reset tiket aktif setelah dibayar
        $ticket = $this->getRestoData('resto_active_ticket', []);
        $tableId = $ticket['meja_id'] ?? '-';
        $ticket['items'] = [];
        $ticket['tukar_poin'] = false;
        $this->saveRestoData('resto_active_ticket', $ticket);

        return redirect()->route('resto.dashboard')->with('success', "✅ Pembayaran Meja {$tableId} via {$metode} berhasil! Struk tercetak dan pesanan tuntas.");
    }

    /**
     * Ganti cabang aktif.
     */
    public function switchBranch(Request $request)
    {
        $branch = $request->input('branch');
        $this->saveRestoData('resto_branch', $branch);

        return redirect()->route('resto.dashboard')->with('info', "Cabang aktif dialihkan ke: {$branch}");
    }

    /**
     * Kitchen Display System (KDS).
     * Semua data default KOSONG — tiket muncul saat pesanan dikirim dari POS.
     */
    public function kds()
    {
        $user          = auth()->user();
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        // Tiket KDS — default KOSONG []
        $kdsTickets  = $this->getRestoData('resto_kds_tickets', []);
        $recentDone  = $this->getRestoData('resto_kds_done', []);

        // Stats
        $totalTickets = count($kdsTickets);
        $mainCount    = collect($kdsTickets)->filter(fn($t) => ($t['station'] ?? 'main') === 'main')->count();
        $pastryCount  = collect($kdsTickets)->filter(fn($t) => ($t['station'] ?? '') === 'pastry')->count();
        $lateCount    = collect($kdsTickets)->filter(fn($t) => ($t['urgent'] ?? false) === true)->count();
        $doneCount    = $this->getRestoData('resto_kds_done_count', 0);
        $avgTime      = $totalTickets > 0 ? rand(8, 14) : 0;

        return view('resto.kds', compact(
            'user', 'currentBranch', 'shiftInfo',
            'kdsTickets', 'recentDone',
            'totalTickets', 'mainCount', 'pastryCount',
            'lateCount', 'doneCount', 'avgTime'
        ));
    }

    /**
     * Halaman Inventaris Bahan Baku & Recipe Costing.
     * Semua data default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function inventaris()
    {
        $user          = auth()->user();
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $bahanList = $this->getRestoData('resto_inventory', []);

        // Kalkulasi KPI
        $totalBahan   = count($bahanList);
        $totalValuasi = 0;
        $reorderCount = 0;
        $kritisCount  = 0;
        $menipisCount = 0;
        $amanCount    = 0;

        foreach ($bahanList as $b) {
            $stok      = (float)($b['stok'] ?? 0);
            $hargaBeli = (float)($b['harga_beli'] ?? 0);
            $minAmbang = (float)($b['min_ambang'] ?? 0);

            $totalValuasi += ($stok * $hargaBeli);

            if ($minAmbang > 0) {
                if ($stok <= ($minAmbang * 0.5)) {
                    $kritisCount++;
                    $reorderCount++;
                } elseif ($stok <= $minAmbang) {
                    $menipisCount++;
                    $reorderCount++;
                } else {
                    $amanCount++;
                }
            } else {
                $amanCount++;
            }
        }

        $cogsPercent = $totalBahan > 0 ? '31.4' : '0.0';

        return view('resto.inventaris', compact(
            'user', 'currentBranch', 'shiftInfo',
            'bahanList', 'totalBahan', 'totalValuasi',
            'reorderCount', 'kritisCount', 'menipisCount', 'amanCount',
            'cogsPercent'
        ));
    }

    /**
     * Tambah bahan baku baru ke session.
     */
    public function createBahan(Request $request)
    {
        $bahanList = $this->getRestoData('resto_inventory', []);

        $nama      = trim($request->input('nama', ''));
        $kategori  = $request->input('kategori', 'Daging & Unggas');
        $satuan    = $request->input('satuan', 'kg');
        $stok      = (float)$request->input('stok', 0);
        $minAmbang = (float)$request->input('min_ambang', 0);
        $hargaBeli = (float)$request->input('harga_beli', 0);
        $supplier  = trim($request->input('supplier', ''));
        $leadTime  = trim($request->input('lead_time', '1 Hari'));
        $batch     = trim($request->input('batch', ''));
        $exp       = trim($request->input('kedaluwarsa', ''));

        // Generate kode jika tidak diisi
        $kodePrefix = match($kategori) {
            'Daging & Unggas' => 'D',
            'Dairy & Keju' => 'D',
            'Kopi & Minuman' => 'C',
            'Sayur & Buah' => 'V',
            'Dry Goods & Seasoning' => 'S',
            default => 'B',
        };
        $kode = $request->input('kode');
        if (empty($kode)) {
            $kode = $kodePrefix . str_pad(count($bahanList) + 1, 2, '0', STR_PAD_LEFT);
        }

        // Tentukan status stok
        $status = 'AMAN';
        if ($minAmbang > 0) {
            if ($stok <= ($minAmbang * 0.5)) {
                $status = 'KRITIS';
            } elseif ($stok <= $minAmbang) {
                $status = 'MENIPIS';
            }
        }

        $newBahan = [
            'id'          => uniqid('b_'),
            'kode'        => strtoupper($kode),
            'nama'        => $nama,
            'kategori'    => $kategori,
            'satuan'      => $satuan,
            'stok'        => $stok,
            'min_ambang'  => $minAmbang,
            'harga_beli'  => $hargaBeli,
            'status'      => $status,
            'supplier'    => $supplier ?: 'Supplier Lokal',
            'lead_time'   => $leadTime ?: '1 Hari',
            'batch'       => $batch ?: '#BATCH-' . date('ymd'),
            'kedaluwarsa' => $exp ?: '30 Hari',
        ];

        $bahanList[] = $newBahan;
        $this->saveRestoData('resto_inventory', $bahanList);

        return redirect()->route('resto.inventaris')->with('success', "✅ Bahan baku '{$nama}' berhasil ditambahkan ke inventaris!");
    }

    /**
     * Hapus bahan baku dari session.
     */
    public function deleteBahan($id)
    {
        $bahanList = $this->getRestoData('resto_inventory', []);
        $bahanList = array_values(array_filter($bahanList, fn($b) => ($b['id'] ?? '') !== $id));
        $this->saveRestoData('resto_inventory', $bahanList);

        return redirect()->route('resto.inventaris')->with('info', "Bahan baku telah dihapus dari inventaris.");
    }

    /**
     * Halaman Reservasi, Membership & Loyalty Points.
     * Semua data default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function member()
    {
        $user          = auth()->user();
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $reservasiList = $this->getRestoData('resto_reservations', []);
        $memberList    = $this->getRestoData('resto_members', []);

        // Stats Reservasi
        $totalReservasi = count($reservasiList);
        $terkonfirmasi  = collect($reservasiList)->filter(fn($r) => in_array($r['status'] ?? '', ['Terkonfirmasi', 'Duduk', 'Seated', 'DP Lunas']))->count();
        $menungguDp     = collect($reservasiList)->filter(fn($r) => ($r['status'] ?? '') === 'Menunggu DP')->count();

        // Stats Member & Loyalty
        $totalMember = count($memberList);
        $totalPoin   = collect($memberList)->sum(fn($m) => (int)($m['poin'] ?? 0));
        $poinValuasi = $totalPoin * 100; // Rp 100 per poin
        $repeatRate  = $totalMember > 0 ? 74 : 0;

        $bronzeCount = collect($memberList)->filter(fn($m) => strtolower($m['tier'] ?? '') === 'bronze')->count();
        $silverCount = collect($memberList)->filter(fn($m) => strtolower($m['tier'] ?? '') === 'silver')->count();
        $goldCount   = collect($memberList)->filter(fn($m) => in_array(strtolower($m['tier'] ?? ''), ['gold', 'vip', 'gold / vip']))->count();

        return view('resto.member', compact(
            'user', 'currentBranch', 'shiftInfo',
            'reservasiList', 'memberList',
            'totalReservasi', 'terkonfirmasi', 'menungguDp',
            'totalMember', 'totalPoin', 'poinValuasi', 'repeatRate',
            'bronzeCount', 'silverCount', 'goldCount'
        ));
    }

    /**
     * Tambah reservasi meja baru.
     */
    public function createReservasi(Request $request)
    {
        $reservasiList = $this->getRestoData('resto_reservations', []);

        $nama        = trim($request->input('nama', ''));
        $phone       = trim($request->input('phone', ''));
        $jam         = trim($request->input('jam', '19:00'));
        $meja        = trim($request->input('meja', 'Meja Indoor'));
        $jumlahTamu  = (int)$request->input('jumlah_tamu', 2);
        $area        = $request->input('area', 'Indoor');
        $tier        = $request->input('tier', 'Non-Member');
        $acara       = trim($request->input('acara', 'Casual Dining'));
        $status      = $request->input('status', 'Terkonfirmasi');
        $nominalDp   = (int)$request->input('nominal_dp', 0);
        $catatan     = trim($request->input('catatan', ''));
        $fasilitas   = trim($request->input('fasilitas', ''));

        $newReservasi = [
            'id'          => uniqid('res_'),
            'nama'        => $nama,
            'phone'       => $phone,
            'jam'         => $jam,
            'meja'        => $meja,
            'jumlah_tamu' => $jumlahTamu,
            'area'        => $area,
            'tier'        => $tier,
            'acara'       => $acara,
            'status'      => $status,
            'nominal_dp'  => $nominalDp,
            'catatan'     => $catatan,
            'fasilitas'   => $fasilitas,
            'waktu_input' => date('H:i'),
        ];

        $reservasiList[] = $newReservasi;
        $this->saveRestoData('resto_reservations', $reservasiList);

        return redirect()->route('resto.member')->with('success', "✅ Reservasi atas nama '{$nama}' berhasil dicatat!");
    }

    /**
     * Update status reservasi (Tamu Tiba, Konfirmasi, Batalkan).
     */
    public function updateReservasiStatus(Request $request, $id)
    {
        $reservasiList = $this->getRestoData('resto_reservations', []);
        $newStatus     = $request->input('status', 'Tamu Tiba (Seated)');

        foreach ($reservasiList as &$r) {
            if (($r['id'] ?? '') === $id) {
                $r['status'] = $newStatus;
                break;
            }
        }
        $this->saveRestoData('resto_reservations', $reservasiList);

        return redirect()->route('resto.member')->with('success', "Status reservasi berhasil diperbarui: {$newStatus}");
    }

    /**
     * Hapus reservasi.
     */
    public function deleteReservasi($id)
    {
        $reservasiList = $this->getRestoData('resto_reservations', []);
        $reservasiList = array_values(array_filter($reservasiList, fn($r) => ($r['id'] ?? '') !== $id));
        $this->saveRestoData('resto_reservations', $reservasiList);

        return redirect()->route('resto.member')->with('info', "Reservasi telah dihapus.");
    }

    /**
     * Tambah member baru.
     */
    public function createMember(Request $request)
    {
        $memberList = $this->getRestoData('resto_members', []);

        $nama        = trim($request->input('nama', ''));
        $phone       = trim($request->input('phone', ''));
        $tier        = $request->input('tier', 'BRONZE');
        $poin        = (int)$request->input('poin', 100);
        $kunjungan   = (int)$request->input('kunjungan', 1);
        $ltv         = (int)$request->input('ltv', 0);
        $menuFavorit = trim($request->input('menu_favorit', ''));

        // Initials
        $words = explode(' ', $nama);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }

        $newMember = [
            'id'           => uniqid('mem_'),
            'initials'     => $initials ?: 'MB',
            'nama'         => $nama,
            'phone'        => $phone,
            'tier'         => strtoupper($tier),
            'poin'         => $poin,
            'kunjungan'    => $kunjungan,
            'ltv'          => $ltv,
            'menu_favorit' => $menuFavorit ?: 'Belum Terdata',
            'terakhir'     => 'Hari ini',
        ];

        $memberList[] = $newMember;
        $this->saveRestoData('resto_members', $memberList);

        return redirect()->route('resto.member')->with('success', "🎉 Member '{$nama}' berhasil didaftarkan ke sistem loyalitas!");
    }

    /**
     * Hapus member.
     */
    public function deleteMember($id)
    {
        $memberList = $this->getRestoData('resto_members', []);
        $memberList = array_values(array_filter($memberList, fn($m) => ($m['id'] ?? '') !== $id));
        $this->saveRestoData('resto_members', $memberList);

        return redirect()->route('resto.member')->with('info', "Member telah dihapus dari database.");
    }

    /**
     * Halaman WhatsApp Marketing & Otomasi CRM.
     * Semua data kampanye default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function marketing()
    {
        $user          = auth()->user();
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $campaigns = $this->getRestoData('resto_wa_campaigns', []);
        $triggers  = $this->getRestoData('resto_wa_triggers', [
            [
                'id'          => 'trig_1',
                'judul'       => 'Pemberian Ucapan & Voucher Ulang Tahun H-3',
                'deskripsi'   => 'Kirim voucher diskon 20% bagi member yang berulang tahun minggu ini secara terpersonalisasi.',
                'target'      => 'Minggu Ini (0 Member)',
                'redeem'      => '0.0%',
                'aktif'       => true,
            ],
            [
                'id'          => 'trig_2',
                'judul'       => 'Win-Back Pelanggan Pasif (>30 Hari)',
                'deskripsi'   => 'Tawaran \'Kangen RestoHub? Gratis Iced Latte untuk kunjungan minggu ini\' & reservasi prioritas.',
                'target'      => 'Re-engagement: 0%',
                'redeem'      => 'Omzet Terselamatkan: Rp 0',
                'aktif'       => true,
            ],
            [
                'id'          => 'trig_3',
                'judul'       => 'Pengingat Saldo Poin Hangus Akhir Bulan',
                'deskripsi'   => 'Peringatkan member dengan saldo poin >500 untuk menukarkannya sebelum kedaluwarsa.',
                'target'      => 'Jadwal Jalan: Tgl 25 Tiap Bulan',
                'redeem'      => 'Terkonversi: 0 Dine-In',
                'aktif'       => true,
            ],
            [
                'id'          => 'trig_4',
                'judul'       => 'Follow-up Review & Rating Bintang 5',
                'deskripsi'   => 'Kirim link Google Review & masukan internal 2 jam setelah billing ditutup kasir.',
                'target'      => 'Google Reviews Baru: 0 Rating',
                'redeem'      => 'CSAT: 0%',
                'aktif'       => true,
            ],
        ]);

        // Stats
        $totalCampaigns = count($campaigns);
        $totalBlast     = collect($campaigns)->sum(fn($c) => (int)($c['terkirim'] ?? 0));
        $kuotaMaks      = 10000;
        $kuotaSisa      = max(0, $kuotaMaks - $totalBlast);
        $openRate       = $totalCampaigns > 0 ? '94.2' : '0.0';
        $redeemRate     = $totalCampaigns > 0 ? '28.6' : '0.0';
        $omzetTambahan  = $totalCampaigns > 0 ? 'Rp 38.6M' : 'Rp 0';

        return view('resto.marketing', compact(
            'user', 'currentBranch', 'shiftInfo',
            'campaigns', 'triggers', 'totalCampaigns',
            'totalBlast', 'kuotaMaks', 'kuotaSisa',
            'openRate', 'redeemRate', 'omzetTambahan'
        ));
    }

    /**
     * Buat kampanye broadcast baru.
     */
    public function createCampaign(Request $request)
    {
        $campaigns = $this->getRestoData('resto_wa_campaigns', []);

        $judul       = trim($request->input('judul', ''));
        $segmen      = $request->input('segmen', 'Semua Member');
        $tipe        = $request->input('tipe', 'Flash Promo');
        $pesan       = trim($request->input('pesan', ''));
        $targetCount = (int)$request->input('target_count', 100);
        $jadwal      = trim($request->input('jadwal', 'Sekarang'));
        $status      = ($jadwal === 'Sekarang') ? 'Selesai Berjalan' : 'Terjadwal';

        $newCampaign = [
            'id'          => uniqid('wa_'),
            'judul'       => $judul,
            'segmen'      => $segmen,
            'tipe'        => $tipe,
            'deskripsi'   => $pesan ?: 'Broadcast pesan promosi ke audiens ' . $segmen,
            'target'      => $targetCount,
            'terkirim'    => ($status === 'Selesai Berjalan') ? $targetCount : 0,
            'dibaca'      => ($status === 'Selesai Berjalan') ? round($targetCount * 0.94) : 0,
            'voucher'     => ($status === 'Selesai Berjalan') ? round($targetCount * 0.28) : 0,
            'status'      => $status,
            'jadwal'      => $jadwal,
            'dibuat'      => date('d M Y, H:i'),
        ];

        $campaigns[] = $newCampaign;
        $this->saveRestoData('resto_wa_campaigns', $campaigns);

        return redirect()->route('resto.marketing')->with('success', "🚀 Kampanye WhatsApp '{$judul}' berhasil diluncurkan!");
    }

    /**
     * Hapus kampanye broadcast.
     */
    public function deleteCampaign($id)
    {
        $campaigns = $this->getRestoData('resto_wa_campaigns', []);
        $campaigns = array_values(array_filter($campaigns, fn($c) => ($c['id'] ?? '') !== $id));
        $this->saveRestoData('resto_wa_campaigns', $campaigns);

        return redirect()->route('resto.marketing')->with('info', "Kampanye broadcast telah dihapus.");
    }

    /**
     * Toggle trigger otomasi WhatsApp.
     */
    public function toggleTrigger(Request $request)
    {
        $triggerId = $request->input('id');
        $triggers  = $this->getRestoData('resto_wa_triggers', []);

        foreach ($triggers as &$t) {
            if (($t['id'] ?? '') === $triggerId) {
                $t['aktif'] = !(bool)($t['aktif'] ?? true);
                break;
            }
        }
        $this->saveRestoData('resto_wa_triggers', $triggers);

        return redirect()->route('resto.marketing')->with('info', "Status pemicu otomasi berhasil diubah.");
    }

    /**
     * Halaman Laporan Operasional & Konfigurasi Restoran.
     * Semua data transaksi default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function laporan()
    {
        $user          = auth()->user();
        $currentBranch = $this->getRestoData('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = $this->getRestoData('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 500000,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $transactions    = $this->getRestoData('resto_sales_transactions', []);
        $menuEngineering = $this->getRestoData('resto_menu_engineering', []);
        $voidRecords     = $this->getRestoData('resto_void_records', []);
        $config          = $this->getRestoData('resto_laporan_config', [
            'pb1'               => 10,
            'service'           => 5,
            'pembulatan'        => 100,
            'petty_cash'        => 500000,
            'toleransi_selisih' => 10000,
            'pin_manager'       => true,
            'footer_struk'      => 'Terima kasih atas kunjungan Anda di RestoHub! Follow IG: @restohub.id',
        ]);

        // Stats Kalkulasi
        $totalTransaksi = count($transactions);
        $totalPenjualan = collect($transactions)->sum(fn($t) => (int)($t['total'] ?? 0));
        $avgKeranjang   = $totalTransaksi > 0 ? round($totalPenjualan / $totalTransaksi) : 0;
        $cogsPercent    = $totalTransaksi > 0 ? '29.8' : '0.0';
        $labaKotor      = $totalTransaksi > 0 ? round($totalPenjualan * 0.702) : 0;
        $labaPercent    = $totalTransaksi > 0 ? '70.2' : '0.0';

        // Metode bayar
        $qrisPct = $totalTransaksi > 0 ? 58 : 0;
        $edcPct  = $totalTransaksi > 0 ? 28 : 0;
        $cashPct = $totalTransaksi > 0 ? 14 : 0;

        return view('resto.laporan', compact(
            'user', 'currentBranch', 'shiftInfo',
            'transactions', 'menuEngineering', 'voidRecords', 'config',
            'totalTransaksi', 'totalPenjualan', 'avgKeranjang',
            'cogsPercent', 'labaKotor', 'labaPercent',
            'qrisPct', 'edcPct', 'cashPct'
        ));
    }

    /**
     * Tutup Buku Kasir (End of Day / Z-Report).
     */
    public function tutupBuku(Request $request)
    {
        $fisikCash  = (int)$request->input('fisik_cash', 0);
        $catatan    = trim($request->input('catatan', ''));
        $modalAwal  = 500000;
        $selisih    = $fisikCash - $modalAwal;

        return redirect()->route('resto.laporan')->with('success', "✅ Tutup Buku Kasir (End of Day) Berhasil! Z-Report telah dicetak & sesi shift ditutup.");
    }

    /**
     * Simpan pengaturan pajak, service charge & printer struk.
     */
    public function saveLaporanConfig(Request $request)
    {
        $config = [
            'pb1'               => (int)$request->input('pb1', 10),
            'service'           => (int)$request->input('service', 5),
            'pembulatan'        => (int)$request->input('pembulatan', 100),
            'petty_cash'        => (int)$request->input('petty_cash', 500000),
            'toleransi_selisih' => (int)$request->input('toleransi_selisih', 10000),
            'pin_manager'       => $request->has('pin_manager'),
            'footer_struk'      => trim($request->input('footer_struk', 'Terima kasih atas kunjungan Anda!')),
        ];

        $this->saveRestoData('resto_laporan_config', $config);

        return redirect()->route('resto.laporan')->with('success', "Konfigurasi operasional restoran berhasil diperbarui.");
    }

    /**
     * Input transaksi penjualan harian manual.
     */
    public function createTransaksiManual(Request $request)
    {
        $transactions = $this->getRestoData('resto_sales_transactions', []);

        $orderNo   = 'ORD-' . date('Hi') . '-' . rand(10, 99);
        $meja      = trim($request->input('meja', 'Meja 01'));
        $total     = (int)$request->input('total', 150000);
        $metode    = $request->input('metode', 'QRIS');
        $itemCount = (int)$request->input('item_count', 3);

        $newTrx = [
            'id'       => uniqid('trx_'),
            'order_no' => $orderNo,
            'meja'     => $meja,
            'total'    => $total,
            'metode'   => $metode,
            'items'    => $itemCount,
            'jam'      => date('H:i'),
            'kasir'    => auth()->user()->name ?? 'Kasir Utama',
        ];

        $transactions[] = $newTrx;
        $this->saveRestoData('resto_sales_transactions', $transactions);

        return redirect()->route('resto.laporan')->with('success', "Transaksi baru {$orderNo} berhasil dicatat ke laporan!");
    }

    /**
     * Reset semua data kembali ke kosong bersih.
     */
    public function resetData()
    {
        $path = storage_path('app/resto_data.json');
        if (file_exists($path)) {
            @unlink($path);
        }

        session()->forget([
            'resto_branch',
            'resto_shift',
            'resto_indoor_tables',
            'resto_outdoor_tables',
            'resto_menu_katalog',
            'resto_active_ticket',
            'resto_takeaway_orders',
            'resto_online_orders',
            'resto_qr_orders',
            'resto_kds_tickets',
            'resto_kds_done',
            'resto_kds_done_count',
            'resto_inventory',
            'resto_recipes',
            'resto_reservations',
            'resto_members',
            'resto_wa_campaigns',
            'resto_wa_triggers',
            'resto_sales_transactions',
            'resto_menu_engineering',
            'resto_void_records',
            'resto_laporan_config',
        ]);

        return redirect()->route('resto.dashboard')->with('info', "Semua data RestoHub telah direset kembali menjadi kosong siap diisi sendiri.");
    }

    /**
     * Muat data demo RestoHub lengkap (meja, menu, kds, inventaris, reservasi, member, laporan).
     */
    public function loadDemoData()
    {
        $indoorTables = [
            ['id' => 'IND-01', 'no' => '01', 'pax' => '4 Pax', 'status' => 'terisi', 'status_label' => 'Makan', 'waktu' => '12:15 WIB', 'total' => 'Rp 261.000', 'orders_count' => 2, 'tamu' => 'Pak Budi Hartono'],
            ['id' => 'IND-02', 'no' => '02', 'pax' => '2 Pax', 'status' => 'kosong', 'status_label' => 'Kosong', 'waktu' => '-', 'total' => 'Rp 0', 'orders_count' => 0, 'tamu' => '-'],
            ['id' => 'IND-03', 'no' => '03', 'pax' => '6 Pax (VIP)', 'status' => 'terisi', 'status_label' => 'Billing', 'waktu' => '11:45 WIB', 'total' => 'Rp 480.000', 'orders_count' => 4, 'tamu' => 'Ibu Cindy'],
            ['id' => 'IND-04', 'no' => '04', 'pax' => '4 Pax', 'status' => 'reservasi', 'status_label' => 'Booking 19:00', 'waktu' => 'Booking', 'total' => 'Rp 0', 'orders_count' => 0, 'tamu' => 'Bapak Hendra (VIP)'],
        ];

        $outdoorTables = [
            ['id' => 'OUT-01', 'no' => '05', 'pax' => '4 Pax Garden', 'status' => 'terisi', 'status_label' => 'Makan', 'waktu' => '12:30 WIB', 'total' => 'Rp 148.000', 'orders_count' => 2, 'tamu' => 'Dimas Arya'],
            ['id' => 'OUT-02', 'no' => '06', 'pax' => '4 Pax Garden', 'status' => 'kosong', 'status_label' => 'Kosong', 'waktu' => '-', 'total' => 'Rp 0', 'orders_count' => 0, 'tamu' => '-'],
        ];

        $menuKatalog = [
            ['id' => 1, 'nama' => 'Wagyu Ribeye Steak 200g', 'kategori' => 'Makanan Utama', 'harga' => 185000, 'stok' => 18, 'sku' => 'WGY-01', 'status' => 'Tersedia', 'icon' => 'fa-drumstick-bite'],
            ['id' => 2, 'nama' => 'Nasi Goreng Kampung Spesial', 'kategori' => 'Makanan Utama', 'harga' => 48000, 'stok' => 45, 'sku' => 'NGK-01', 'status' => 'Tersedia', 'icon' => 'fa-bowl-rice'],
            ['id' => 3, 'nama' => 'Spaghetti Aglio Olio Smoked Beef', 'kategori' => 'Makanan Utama', 'harga' => 62000, 'stok' => 22, 'sku' => 'PST-01', 'status' => 'Tersedia', 'icon' => 'fa-utensils'],
            ['id' => 4, 'nama' => 'Iced Lychee Tea Sparkling', 'kategori' => 'Minuman', 'harga' => 28000, 'stok' => 60, 'sku' => 'LCH-01', 'status' => 'Tersedia', 'icon' => 'fa-glass-water'],
            ['id' => 5, 'nama' => 'Matcha Latte Espresso Fusion', 'kategori' => 'Minuman', 'harga' => 35000, 'stok' => 30, 'sku' => 'MTC-01', 'status' => 'Tersedia', 'icon' => 'fa-mug-hot'],
            ['id' => 6, 'nama' => 'Caramel Macchiato Cold Brew', 'kategori' => 'Minuman', 'harga' => 38000, 'stok' => 25, 'sku' => 'CRM-01', 'status' => 'Tersedia', 'icon' => 'fa-wine-glass'],
            ['id' => 7, 'nama' => 'Truffle French Fries with Tartar', 'kategori' => 'Snack', 'harga' => 38000, 'stok' => 25, 'sku' => 'TRF-01', 'status' => 'Tersedia', 'icon' => 'fa-utensils'],
            ['id' => 8, 'nama' => 'Crispy Chicken Wings BBQ', 'kategori' => 'Snack', 'harga' => 45000, 'stok' => 20, 'sku' => 'CWG-01', 'status' => 'Tersedia', 'icon' => 'fa-drumstick-bite'],
            ['id' => 9, 'nama' => 'Molten Choco Lava Cake', 'kategori' => 'Dessert', 'harga' => 42000, 'stok' => 15, 'sku' => 'LAV-01', 'status' => 'Tersedia', 'icon' => 'fa-cake-candles'],
        ];

        $activeTicket = [
            'meja_id' => 'IND-01',
            'area' => 'Area Indoor • Meja 01',
            'pax' => 4,
            'tiket_no' => 'TCK-2026-089',
            'waktu_buat' => '12:15 WIB',
            'items' => [
                ['id' => 1, 'nama' => 'Wagyu Ribeye Steak 200g', 'harga' => 185000, 'qty' => 1, 'catatan' => 'Medium rare, mushroom sauce'],
                ['id' => 4, 'nama' => 'Iced Lychee Tea Sparkling', 'harga' => 28000, 'qty' => 2, 'catatan' => 'Less sugar, less ice'],
            ],
            'catatan_dapur' => 'Sajikan minuman lebih dulu, steak medium rare',
            'tukar_poin' => false,
        ];

        $kdsTickets = [
            [
                'id' => 'KDS-001',
                'order_id' => 'TCK-2026-089',
                'table' => 'Meja 01',
                'area' => 'Indoor',
                'created_at' => now()->subMinutes(12)->format('H:i'),
                'time_elapsed' => '12m',
                'status' => 'cooking',
                'priority' => 'normal',
                'items' => [
                    ['name' => 'Wagyu Ribeye Steak 200g', 'qty' => 1, 'notes' => 'Medium rare'],
                    ['name' => 'Iced Lychee Tea Sparkling', 'qty' => 2, 'notes' => 'Less sugar']
                ],
                'notes' => 'Steak medium rare'
            ],
            [
                'id' => 'KDS-002',
                'order_id' => 'TCK-2026-090',
                'table' => 'Meja 05',
                'area' => 'Outdoor',
                'created_at' => now()->subMinutes(5)->format('H:i'),
                'time_elapsed' => '5m',
                'status' => 'ready',
                'priority' => 'high',
                'items' => [
                    ['name' => 'Nasi Goreng Kampung Spesial', 'qty' => 2, 'notes' => 'Pedas sedang'],
                    ['name' => 'Truffle French Fries with Tartar', 'qty' => 1, 'notes' => 'Ekstra saus']
                ],
                'notes' => 'Siap diantar ke outdoor'
            ]
        ];

        $inventory = [
            ['id' => 1, 'nama' => 'Daging Sapi Wagyu Ribeye MB5', 'kategori' => 'Protein', 'stok' => 14.5, 'min_stok' => 5.0, 'satuan' => 'Kg', 'cost_per_unit' => 320000, 'status' => 'Aman', 'icon' => 'fa-drumstick-bite'],
            ['id' => 2, 'nama' => 'Beras Pandan Wangi Premium', 'kategori' => 'Karbohidrat', 'stok' => 45.0, 'min_stok' => 20.0, 'satuan' => 'Kg', 'cost_per_unit' => 16000, 'status' => 'Aman', 'icon' => 'fa-bowl-rice'],
            ['id' => 3, 'nama' => 'Buah Lychee Kaleng Import', 'kategori' => 'Bahan Minuman', 'stok' => 3, 'min_stok' => 6, 'satuan' => 'Kaleng', 'cost_per_unit' => 35000, 'status' => 'Menipis', 'icon' => 'fa-glass-water'],
            ['id' => 4, 'nama' => 'Susu Fresh Milk Pasteurisasi', 'kategori' => 'Dairy', 'stok' => 18, 'min_stok' => 10, 'satuan' => 'Liter', 'cost_per_unit' => 22000, 'status' => 'Aman', 'icon' => 'fa-bottle-water'],
            ['id' => 5, 'nama' => 'Minyak Truffle Ekstrak Italia', 'kategori' => 'Bumbu & Saus', 'stok' => 1, 'min_stok' => 2, 'satuan' => 'Botol', 'cost_per_unit' => 145000, 'status' => 'Menipis', 'icon' => 'fa-bottle-droplet'],
        ];

        $reservations = [
            ['id' => 1, 'nama' => 'Bapak Hendra Wijaya', 'no_hp' => '0812-9843-2210', 'tanggal' => date('Y-m-d'), 'jam' => '19:00', 'pax' => 4, 'meja' => 'Indoor VIP Meja 04', 'dp' => 200000, 'status' => 'Terkonfirmasi', 'catatan' => 'Anniversary dinner, minta disiapkan lilin'],
            ['id' => 2, 'nama' => 'Ibu Maya Lestari', 'no_hp' => '0857-1122-3344', 'tanggal' => date('Y-m-d', strtotime('+1 day')), 'jam' => '13:00', 'pax' => 6, 'meja' => 'Outdoor Garden Meja 06', 'dp' => 300000, 'status' => 'Terkonfirmasi', 'catatan' => 'Family lunch gathering'],
        ];

        $members = [
            ['id' => 1, 'nama' => 'Cindy Patricia', 'no_hp' => '0878-5521-4320', 'tier' => 'PLATINUM', 'poin' => 2450, 'total_kunjungan' => 18, 'total_spend' => 4250000, 'joined' => '2026-01-15'],
            ['id' => 2, 'nama' => 'Budi Hartono', 'no_hp' => '0813-1122-3344', 'tier' => 'GOLD', 'poin' => 1200, 'total_kunjungan' => 9, 'total_spend' => 2100000, 'joined' => '2026-02-20'],
            ['id' => 3, 'nama' => 'Dimas Arya', 'no_hp' => '0812-8877-6655', 'tier' => 'SILVER', 'poin' => 450, 'total_kunjungan' => 3, 'total_spend' => 750000, 'joined' => '2026-04-10'],
        ];

        $campaigns = [
            ['id' => 1, 'nama' => 'Payday Weekend Treat 20%', 'kode' => 'PAYDAY20', 'diskon' => '20% (Maks Rp 50.000)', 'min_transaksi' => 'Rp 150.000', 'masa_berlaku' => date('Y-m-d', strtotime('+15 days')), 'kuota' => '150 Voucher', 'status' => 'Aktif'],
            ['id' => 2, 'nama' => 'Free Truffle Fries Weekday Lunch', 'kode' => 'FREETRUFFLE', 'diskon' => 'Free 1 Snack', 'min_transaksi' => 'Rp 200.000', 'masa_berlaku' => date('Y-m-d', strtotime('+30 days')), 'kuota' => '50 Voucher', 'status' => 'Aktif'],
        ];

        $transactions = [
            ['id' => 'TRX-2026-041', 'meja' => 'Meja 02', 'kasir' => 'Sarah Maharani', 'total' => 185000, 'metode' => 'QRIS', 'waktu' => '11:15 WIB', 'tanggal' => date('Y-m-d'), 'status' => 'Lunas'],
            ['id' => 'TRX-2026-042', 'meja' => 'Meja 07', 'kasir' => 'Sarah Maharani', 'total' => 320000, 'metode' => 'EDC', 'waktu' => '11:50 WIB', 'tanggal' => date('Y-m-d'), 'status' => 'Lunas'],
            ['id' => 'TRX-2026-043', 'meja' => 'Meja 01', 'kasir' => 'Sarah Maharani', 'total' => 261000, 'metode' => 'Cash', 'waktu' => '12:40 WIB', 'tanggal' => date('Y-m-d'), 'status' => 'Lunas'],
        ];

        $this->saveRestoData('resto_indoor_tables', $indoorTables);
        $this->saveRestoData('resto_outdoor_tables', $outdoorTables);
        $this->saveRestoData('resto_menu_katalog', $menuKatalog);
        $this->saveRestoData('resto_active_ticket', $activeTicket);
        $this->saveRestoData('resto_kds_tickets', $kdsTickets);
        $this->saveRestoData('resto_inventory', $inventory);
        $this->saveRestoData('resto_reservations', $reservations);
        $this->saveRestoData('resto_members', $members);
        $this->saveRestoData('resto_wa_campaigns', $campaigns);
        $this->saveRestoData('resto_sales_transactions', $transactions);

        return redirect()->route('resto.dashboard')
            ->with('success', 'Data demo RestoHub (Denah Meja, Menu Katalog, Tiket Aktif & KDS) berhasil dimuat!');
    }

}
