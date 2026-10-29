<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelDashboardController extends Controller
{
    /**
     * Inisialisasi data default session travel jika belum ada
     */
    protected function initSessionData()
    {
        if (!session()->has('travel_packages')) {
            session([
                'travel_packages' => [
                    [
                        'id' => 'PKT-01',
                        'nama' => 'Umroh Khazanah Barokah 9 Hari (Bintang 5)',
                        'kategori' => 'Umroh & Religi',
                        'durasi' => '9H 8M',
                        'tanggal_berangkat' => '18 Nov 2026',
                        'kuota_total' => 45,
                        'kuota_terisi' => 42,
                        'harga' => 31500000,
                        'status' => 'Tersedia',
                        'tour_leader' => 'Ust. H. Ahmad Fauzi, Lc.',
                    ],
                    [
                        'id' => 'PKT-02',
                        'nama' => 'Exotic Labuan Bajo Phinisi Liveaboard 3D2N',
                        'kategori' => 'Domestik Premium',
                        'durasi' => '3H 2M',
                        'tanggal_berangkat' => '04 Des 2026',
                        'kuota_total' => 16,
                        'kuota_terisi' => 16,
                        'harga' => 5850000,
                        'status' => 'Penuh',
                        'tour_leader' => 'Rian Prawira',
                    ],
                    [
                        'id' => 'PKT-03',
                        'nama' => 'Japan Golden Route Sakura Autumn 7D6N',
                        'kategori' => 'Internasional',
                        'durasi' => '7H 6M',
                        'tanggal_berangkat' => '12 Des 2026',
                        'kuota_total' => 25,
                        'kuota_terisi' => 19,
                        'harga' => 23900000,
                        'status' => 'Tersedia',
                        'tour_leader' => 'Sarah Tanaka',
                    ],
                    [
                        'id' => 'PKT-04',
                        'nama' => 'Open Trip Bromo Sunrise & Rafting 3D2N',
                        'kategori' => 'Open Trip',
                        'durasi' => '3H 2M',
                        'tanggal_berangkat' => '20 Nov 2026',
                        'kuota_total' => 30,
                        'kuota_terisi' => 28,
                        'harga' => 1450000,
                        'status' => 'Tersedia',
                        'tour_leader' => 'Bagus Ramadhan',
                    ],
                ]
            ]);
        }

        if (!session()->has('travel_participants')) {
            session([
                'travel_participants' => [
                    [
                        'id' => 'JMH-001',
                        'nama' => 'H. Syamsudin & Hj. Mariam',
                        'paket_id' => 'PKT-01',
                        'paket_nama' => 'Umroh Khazanah Barokah 9 Hari',
                        'no_wa' => '081299881122',
                        'paspor' => 'B8912344 (Exp 2029)',
                        'status_dokumen' => 'Visa Issued & Tiket Siap',
                        'status_pembayaran' => 'Lunas',
                        'total_tagihan' => 63000000,
                        'tanggal_daftar' => '10 Okt 2026',
                    ],
                    [
                        'id' => 'JMH-002',
                        'nama' => 'Denny Wicaksono & Partner',
                        'paket_id' => 'PKT-02',
                        'paket_nama' => 'Exotic Labuan Bajo Phinisi 3D2N',
                        'no_wa' => '085712349988',
                        'paspor' => 'KTP Verified',
                        'status_dokumen' => 'Manifest Phinisi Terdaftar',
                        'status_pembayaran' => 'Lunas',
                        'total_tagihan' => 11700000,
                        'tanggal_daftar' => '15 Okt 2026',
                    ],
                    [
                        'id' => 'JMH-003',
                        'nama' => 'Dr. Amelia Putri',
                        'paket_id' => 'PKT-03',
                        'paket_nama' => 'Japan Golden Route Sakura Autumn',
                        'no_wa' => '081377884455',
                        'paspor' => 'C1290881 (Exp 2028)',
                        'status_dokumen' => 'E-Visa Jepang Approved',
                        'status_pembayaran' => 'DP 50% Terbayar',
                        'total_tagihan' => 23900000,
                        'tanggal_daftar' => '22 Okt 2026',
                    ],
                    [
                        'id' => 'JMH-004',
                        'nama' => 'Fajar Nugroho',
                        'paket_id' => 'PKT-04',
                        'paket_nama' => 'Open Trip Bromo Sunrise & Rafting',
                        'no_wa' => '082155667788',
                        'paspor' => 'KTP Verified',
                        'status_dokumen' => 'Siap Berangkat',
                        'status_pembayaran' => 'Lunas',
                        'total_tagihan' => 1450000,
                        'tanggal_daftar' => '25 Okt 2026',
                    ],
                ]
            ]);
        }

        if (!session()->has('travel_armada')) {
            session([
                'travel_armada' => [
                    [
                        'id' => 'ARM-01',
                        'nama_kendaraan' => 'Bus Pariwisata Executive Jetbus 5',
                        'kapasitas' => '45 Seat (2-2)',
                        'plat_nomor' => 'B 7890 TGA',
                        'vendor' => 'PO Nusantara Trans Luxury',
                        'status' => 'Siap Jalan',
                        'driver' => 'Pak Joko Triyono',
                        'rute_tujuan' => 'Bandara Soetta - Cengkareng',
                    ],
                    [
                        'id' => 'ARM-02',
                        'nama_kendaraan' => 'Kapal Phinisi Deluxe Ocean Cruiser',
                        'kapasitas' => '16 Guest Cabin',
                        'plat_nomor' => 'KM Phinisi Bajo 01',
                        'vendor' => 'Labuan Marine Charters',
                        'status' => 'Standby di Dermaga',
                        'driver' => 'Capt. Markus',
                        'rute_tujuan' => 'Komodo Island - Padar - Pink Beach',
                    ],
                    [
                        'id' => 'ARM-03',
                        'nama_kendaraan' => 'Toyota HiAce Commuter Executive',
                        'kapasitas' => '14 Seat',
                        'plat_nomor' => 'N 1422 WZ',
                        'vendor' => 'Bromo Adventure Fleet',
                        'status' => 'Siap Jalan',
                        'driver' => 'Mas Dimas',
                        'rute_tujuan' => 'Malang - Sukapura Bromo',
                    ],
                ]
            ]);
        }
    }

    /**
     * Dashboard Overview L-Travel
     */
    public function index(Request $request)
    {
        $this->initSessionData();

        $packages = session('travel_packages', []);
        $participants = session('travel_participants', []);
        $armada = session('travel_armada', []);

        $totalPackages = count($packages);
        $totalParticipants = count($participants);
        $totalArmada = count($armada);

        $totalSeatKapasitas = array_reduce($packages, fn($acc, $p) => $acc + $p['kuota_total'], 0);
        $totalSeatTerisi = array_reduce($packages, fn($acc, $p) => $acc + $p['kuota_terisi'], 0);
        $okupansiPersen = $totalSeatKapasitas > 0 ? round(($totalSeatTerisi / $totalSeatKapasitas) * 100, 1) : 0;

        $omzetTerkontrak = array_reduce($participants, fn($acc, $pt) => $acc + $pt['total_tagihan'], 0);

        $isSubscriber = auth()->check() && (auth()->user()->isTravelOrAdmin());
        $user = auth()->user();

        return view('travel.dashboard', compact(
            'packages',
            'participants',
            'armada',
            'totalPackages',
            'totalParticipants',
            'totalArmada',
            'totalSeatKapasitas',
            'totalSeatTerisi',
            'okupansiPersen',
            'omzetTerkontrak',
            'isSubscriber',
            'user'
        ));
    }

    /**
     * Halaman Manajemen Paket Tour & Travel
     */
    public function paket()
    {
        $this->initSessionData();
        $packages = session('travel_packages', []);
        $isSubscriber = auth()->check() && (auth()->user()->isTravelOrAdmin());

        return view('travel.paket', compact('packages', 'isSubscriber'));
    }

    /**
     * Tambah Paket Baru
     */
    public function storePaket(Request $request)
    {
        $this->initSessionData();
        $packages = session('travel_packages', []);

        $newPackage = [
            'id' => 'PKT-' . str_pad(count($packages) + 1, 2, '0', STR_PAD_LEFT),
            'nama' => $request->input('nama', 'Paket Wisata Baru'),
            'kategori' => $request->input('kategori', 'Domestik'),
            'durasi' => $request->input('durasi', '3H 2M'),
            'tanggal_berangkat' => $request->input('tanggal_berangkat', date('d M Y', strtotime('+1 month'))),
            'kuota_total' => (int) $request->input('kuota_total', 20),
            'kuota_terisi' => 0,
            'harga' => (int) $request->input('harga', 3500000),
            'status' => 'Tersedia',
            'tour_leader' => $request->input('tour_leader', 'Tim Operasional L-Travel'),
        ];

        array_unshift($packages, $newPackage);
        session(['travel_packages' => $packages]);

        return redirect()->back()->with('success', 'Paket tour & perjalanan baru berhasil ditambahkan!');
    }

    /**
     * Halaman Peserta & Jamaah (Manifest)
     */
    public function jamaah()
    {
        $this->initSessionData();
        $participants = session('travel_participants', []);
        $packages = session('travel_packages', []);
        $isSubscriber = auth()->check() && (auth()->user()->isTravelOrAdmin());

        return view('travel.jamaah', compact('participants', 'packages', 'isSubscriber'));
    }

    /**
     * Registrasi Peserta / Jamaah Baru
     */
    public function storeJamaah(Request $request)
    {
        $this->initSessionData();
        $participants = session('travel_participants', []);
        $packages = session('travel_packages', []);

        $packageId = $request->input('paket_id');
        $packageNama = 'Paket Dipilih';
        $hargaPaket = 5000000;

        foreach ($packages as &$p) {
            if ($p['id'] === $packageId) {
                $packageNama = $p['nama'];
                $hargaPaket = $p['harga'];
                $p['kuota_terisi'] += 1;
                if ($p['kuota_terisi'] >= $p['kuota_total']) {
                    $p['status'] = 'Penuh';
                }
                break;
            }
        }
        session(['travel_packages' => $packages]);

        $newParticipant = [
            'id' => 'JMH-' . str_pad(count($participants) + 1, 3, '0', STR_PAD_LEFT),
            'nama' => $request->input('nama'),
            'paket_id' => $packageId,
            'paket_nama' => $packageNama,
            'no_wa' => $request->input('no_wa'),
            'paspor' => $request->input('paspor', 'KTP Verified'),
            'status_dokumen' => $request->input('status_dokumen', 'Berkas Diterima'),
            'status_pembayaran' => $request->input('status_pembayaran', 'DP Terbayar'),
            'total_tagihan' => (int) $request->input('total_tagihan', $hargaPaket),
            'tanggal_daftar' => date('d M Y'),
        ];

        array_unshift($participants, $newParticipant);
        session(['travel_participants' => $participants]);

        return redirect()->back()->with('success', 'Data peserta / jamaah baru berhasil ditambahkan ke manifest!');
    }

    /**
     * Halaman Keuangan & Tagihan Invoice
     */
    public function keuangan()
    {
        $this->initSessionData();
        $participants = session('travel_participants', []);
        $packages = session('travel_packages', []);
        $isSubscriber = auth()->check() && (auth()->user()->isTravelOrAdmin());

        return view('travel.keuangan', compact('participants', 'packages', 'isSubscriber'));
    }

    /**
     * Halaman Armada & Transportasi
     */
    public function armada()
    {
        $this->initSessionData();
        $armada = session('travel_armada', []);
        $isSubscriber = auth()->check() && (auth()->user()->isTravelOrAdmin());

        return view('travel.armada', compact('armada', 'isSubscriber'));
    }

    /**
     * Tambah Armada Transportasi
     */
    public function storeArmada(Request $request)
    {
        $this->initSessionData();
        $armada = session('travel_armada', []);

        $newArmada = [
            'id' => 'ARM-' . str_pad(count($armada) + 1, 2, '0', STR_PAD_LEFT),
            'nama_kendaraan' => $request->input('nama_kendaraan', 'Armada Baru'),
            'kapasitas' => $request->input('kapasitas', '14 Seat'),
            'plat_nomor' => $request->input('plat_nomor', 'B 1234 XYZ'),
            'vendor' => $request->input('vendor', 'Mitra Transport'),
            'status' => 'Siap Jalan',
            'driver' => $request->input('driver', 'Driver Ditugaskan'),
            'rute_tujuan' => $request->input('rute_tujuan', 'Operasional Tour'),
        ];

        array_unshift($armada, $newArmada);
        session(['travel_armada' => $armada]);

        return redirect()->back()->with('success', 'Data armada transportasi baru berhasil didaftarkan!');
    }

    /**
     * Reset Demo Data
     */
    public function resetData()
    {
        session()->forget(['travel_packages', 'travel_participants', 'travel_armada']);
        return redirect()->route('travel.dashboard')->with('success', 'Data demo L-Travel berhasil di-reset ke kondisi awal!');
    }
}

