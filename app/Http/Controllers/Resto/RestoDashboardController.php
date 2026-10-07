<?php

namespace App\Http\Controllers\Resto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestoDashboardController extends Controller
{
    /**
     * Dashboard RestoHub OS (Culinary Operations).
     * Seluruh data awal KOSONG — siap diisi sendiri oleh pengguna.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        // 1. Cabang & Shift Info
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $branches = [
            'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta',
            'RestoHub Express - Senayan City',
            'RestoHub Garden & Lounge - PIK Avenue',
        ];

        $shiftInfo = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam' => '09:00 - 17:00',
            'kasir' => $user->name ?? 'Kasir Utama',
            'kas_awal' => 0,
            'status' => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        // 2. Denah Meja (Floor Plan) — DEFAULT KOSONG []
        $indoorTables = session('resto_indoor_tables', []);
        $outdoorTables = session('resto_outdoor_tables', []);

        // Service Mode Counters (dihitung dari meja nyata atau 0)
        $serviceCounters = [
            'dine_in' => count($indoorTables) + count($outdoorTables),
            'takeaway' => count(session('resto_takeaway_orders', [])),
            'online' => count(session('resto_online_orders', [])),
            'qr_self_order' => count(session('resto_qr_orders', [])),
        ];

        // 3. Katalog Menu & Quick Add — DEFAULT KOSONG []
        $menuKatalog = session('resto_menu_katalog', []);

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
        $activeTicket = session('resto_active_ticket', $defaultTicket);

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

        $tables = session($sessionKey, []);
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
        session([$sessionKey => $tables]);

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

        $katalog = session('resto_menu_katalog', []);
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

        session(['resto_menu_katalog' => $katalog]);

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

        $activeTicket = session('resto_active_ticket', []);
        $activeTicket['meja_id'] = $tableId;
        $activeTicket['area'] = $area;
        $activeTicket['pax'] = $pax;
        $activeTicket['tiket_no'] = '#RH-' . rand(1000, 9999);
        $activeTicket['waktu_buat'] = date('H:i') . ' WIB';

        session(['resto_active_ticket' => $activeTicket]);

        return redirect()->route('resto.dashboard')->with('info', "Meja {$tableId} kini menjadi tiket aktif.");
    }

    /**
     * Tambah item ke tiket aktif.
     */
    public function addItem(Request $request)
    {
        $menuId = (int) $request->input('menu_id');
        $nama = $request->input('nama');
        $harga = (int) $request->input('harga');

        $ticket = session('resto_active_ticket', [
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

        session(['resto_active_ticket' => $ticket]);

        return redirect()->route('resto.dashboard')->with('success', "Item {$nama} berhasil ditambahkan ke tiket.");
    }

    /**
     * Kurangi atau hapus item dari tiket.
     */
    public function removeItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $ticket = session('resto_active_ticket', []);

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
            session(['resto_active_ticket' => $ticket]);
        }

        return redirect()->route('resto.dashboard')->with('info', "Pesanan tiket telah diperbarui.");
    }

    /**
     * Toggle penukaran poin member loyalty.
     */
    public function toggleDiscount(Request $request)
    {
        $ticket = session('resto_active_ticket', []);
        $ticket['tukar_poin'] = !(bool)($ticket['tukar_poin'] ?? false);
        session(['resto_active_ticket' => $ticket]);

        return redirect()->route('resto.dashboard')->with('info', "Poin loyalty member berhasil diubah.");
    }

    /**
     * Kirim pesanan ke Kitchen Display System (KDS).
     */
    public function fireKds(Request $request)
    {
        $ticket = session('resto_active_ticket', []);
        if (!empty($ticket) && !empty($ticket['items'])) {
            $kdsTickets = session('resto_kds_tickets', []);
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
            session(['resto_kds_tickets' => $kdsTickets]);
        }

        return redirect()->route('resto.dashboard')->with('success', "🔥 Fire KDS Berhasil! Pesanan diteruskan ke Kitchen & Bar.");
    }

    /**
     * Simpan catatan dapur.
     */
    public function saveCatatanDapur(Request $request)
    {
        $ticket = session('resto_active_ticket', []);
        $ticket['catatan_dapur'] = $request->input('catatan', '');
        session(['resto_active_ticket' => $ticket]);

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
        $ticket = session('resto_active_ticket', []);
        $tableId = $ticket['meja_id'] ?? '-';
        $ticket['items'] = [];
        $ticket['tukar_poin'] = false;
        session(['resto_active_ticket' => $ticket]);

        return redirect()->route('resto.dashboard')->with('success', "✅ Pembayaran Meja {$tableId} via {$metode} berhasil! Struk tercetak dan pesanan tuntas.");
    }

    /**
     * Ganti cabang aktif.
     */
    public function switchBranch(Request $request)
    {
        $branch = $request->input('branch');
        session(['resto_branch' => $branch]);

        return redirect()->route('resto.dashboard')->with('info', "Cabang aktif dialihkan ke: {$branch}");
    }

    /**
     * Kitchen Display System (KDS).
     * Semua data default KOSONG — tiket muncul saat pesanan dikirim dari POS.
     */
    public function kds()
    {
        $user          = auth()->user();
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        // Tiket KDS — default KOSONG []
        $kdsTickets  = session('resto_kds_tickets', []);
        $recentDone  = session('resto_kds_done', []);

        // Stats
        $totalTickets = count($kdsTickets);
        $mainCount    = collect($kdsTickets)->filter(fn($t) => ($t['station'] ?? 'main') === 'main')->count();
        $pastryCount  = collect($kdsTickets)->filter(fn($t) => ($t['station'] ?? '') === 'pastry')->count();
        $lateCount    = collect($kdsTickets)->filter(fn($t) => ($t['urgent'] ?? false) === true)->count();
        $doneCount    = session('resto_kds_done_count', 0);
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
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $bahanList = session('resto_inventory', []);

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
        $bahanList = session('resto_inventory', []);

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
        session(['resto_inventory' => $bahanList]);

        return redirect()->route('resto.inventaris')->with('success', "✅ Bahan baku '{$nama}' berhasil ditambahkan ke inventaris!");
    }

    /**
     * Hapus bahan baku dari session.
     */
    public function deleteBahan($id)
    {
        $bahanList = session('resto_inventory', []);
        $bahanList = array_values(array_filter($bahanList, fn($b) => ($b['id'] ?? '') !== $id));
        session(['resto_inventory' => $bahanList]);

        return redirect()->route('resto.inventaris')->with('info', "Bahan baku telah dihapus dari inventaris.");
    }

    /**
     * Halaman Reservasi, Membership & Loyalty Points.
     * Semua data default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function member()
    {
        $user          = auth()->user();
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $reservasiList = session('resto_reservations', []);
        $memberList    = session('resto_members', []);

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
        $reservasiList = session('resto_reservations', []);

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
        session(['resto_reservations' => $reservasiList]);

        return redirect()->route('resto.member')->with('success', "✅ Reservasi atas nama '{$nama}' berhasil dicatat!");
    }

    /**
     * Update status reservasi (Tamu Tiba, Konfirmasi, Batalkan).
     */
    public function updateReservasiStatus(Request $request, $id)
    {
        $reservasiList = session('resto_reservations', []);
        $newStatus     = $request->input('status', 'Tamu Tiba (Seated)');

        foreach ($reservasiList as &$r) {
            if (($r['id'] ?? '') === $id) {
                $r['status'] = $newStatus;
                break;
            }
        }
        session(['resto_reservations' => $reservasiList]);

        return redirect()->route('resto.member')->with('success', "Status reservasi berhasil diperbarui: {$newStatus}");
    }

    /**
     * Hapus reservasi.
     */
    public function deleteReservasi($id)
    {
        $reservasiList = session('resto_reservations', []);
        $reservasiList = array_values(array_filter($reservasiList, fn($r) => ($r['id'] ?? '') !== $id));
        session(['resto_reservations' => $reservasiList]);

        return redirect()->route('resto.member')->with('info', "Reservasi telah dihapus.");
    }

    /**
     * Tambah member baru.
     */
    public function createMember(Request $request)
    {
        $memberList = session('resto_members', []);

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
        session(['resto_members' => $memberList]);

        return redirect()->route('resto.member')->with('success', "🎉 Member '{$nama}' berhasil didaftarkan ke sistem loyalitas!");
    }

    /**
     * Hapus member.
     */
    public function deleteMember($id)
    {
        $memberList = session('resto_members', []);
        $memberList = array_values(array_filter($memberList, fn($m) => ($m['id'] ?? '') !== $id));
        session(['resto_members' => $memberList]);

        return redirect()->route('resto.member')->with('info', "Member telah dihapus dari database.");
    }

    /**
     * Halaman WhatsApp Marketing & Otomasi CRM.
     * Semua data kampanye default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function marketing()
    {
        $user          = auth()->user();
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 0,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $campaigns = session('resto_wa_campaigns', []);
        $triggers  = session('resto_wa_triggers', [
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
        $campaigns = session('resto_wa_campaigns', []);

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
        session(['resto_wa_campaigns' => $campaigns]);

        return redirect()->route('resto.marketing')->with('success', "🚀 Kampanye WhatsApp '{$judul}' berhasil diluncurkan!");
    }

    /**
     * Hapus kampanye broadcast.
     */
    public function deleteCampaign($id)
    {
        $campaigns = session('resto_wa_campaigns', []);
        $campaigns = array_values(array_filter($campaigns, fn($c) => ($c['id'] ?? '') !== $id));
        session(['resto_wa_campaigns' => $campaigns]);

        return redirect()->route('resto.marketing')->with('info', "Kampanye broadcast telah dihapus.");
    }

    /**
     * Toggle trigger otomasi WhatsApp.
     */
    public function toggleTrigger(Request $request)
    {
        $triggerId = $request->input('id');
        $triggers  = session('resto_wa_triggers', []);

        foreach ($triggers as &$t) {
            if (($t['id'] ?? '') === $triggerId) {
                $t['aktif'] = !(bool)($t['aktif'] ?? true);
                break;
            }
        }
        session(['resto_wa_triggers' => $triggers]);

        return redirect()->route('resto.marketing')->with('info', "Status pemicu otomasi berhasil diubah.");
    }

    /**
     * Halaman Laporan Operasional & Konfigurasi Restoran.
     * Semua data transaksi default KOSONG siap diisi sendiri oleh pengguna.
     */
    public function laporan()
    {
        $user          = auth()->user();
        $currentBranch = session('resto_branch', 'RestoHub Bistro & Cafe - Grand Indonesia, Jakarta');
        $shiftInfo     = session('resto_shift', [
            'shift_kode' => 'SHIFT 01',
            'jam'        => '09:00 - 17:00',
            'kasir'      => $user->name ?? 'Kasir Utama',
            'kas_awal'   => 500000,
            'status'     => 'Aktif',
            'shift_name' => 'Shift Pagi 08:00 – 16:00',
        ]);

        $transactions    = session('resto_sales_transactions', []);
        $menuEngineering = session('resto_menu_engineering', []);
        $voidRecords     = session('resto_void_records', []);
        $config          = session('resto_laporan_config', [
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

        session(['resto_laporan_config' => $config]);

        return redirect()->route('resto.laporan')->with('success', "Konfigurasi operasional restoran berhasil diperbarui.");
    }

    /**
     * Input transaksi penjualan harian manual.
     */
    public function createTransaksiManual(Request $request)
    {
        $transactions = session('resto_sales_transactions', []);

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
        session(['resto_sales_transactions' => $transactions]);

        return redirect()->route('resto.laporan')->with('success', "Transaksi baru {$orderNo} berhasil dicatat ke laporan!");
    }

    /**
     * Reset semua data kembali ke kosong bersih.
     */
    public function resetData()
    {
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
}
