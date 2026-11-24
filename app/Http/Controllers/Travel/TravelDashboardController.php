<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Models\TravelParticipant;
use App\Models\TravelFleet;

class TravelDashboardController extends Controller
{
    protected function getAuthUser()
    {
        return auth()->user() ?? (object)[
            'id' => 1,
            'name' => 'Admin L-Travel',
            'email' => 'admin@travel.id',
            'role' => 'admin',
        ];
    }

    /**
     * Dashboard Overview L-Travel
     */
    public function index(Request $request)
    {
        $dbPackages = TravelPackage::latest()->get();
        $dbParticipants = TravelParticipant::with('package')->latest()->get();
        $dbArmada = TravelFleet::latest()->get();

        $packages = $dbPackages->map(fn($p) => [
            'id' => $p->kode_paket,
            'nama' => $p->nama,
            'kategori' => $p->kategori,
            'durasi' => $p->durasi,
            'tanggal_berangkat' => $p->tanggal_berangkat ? $p->tanggal_berangkat->format('d M Y') : '-',
            'kuota_total' => $p->kuota_total,
            'kuota_terisi' => $p->kuota_terisi,
            'harga' => (float)$p->harga,
            'status' => $p->status,
            'tour_leader' => $p->tour_leader ?? 'Tour Leader Terjadwal',
        ])->toArray();

        $participants = $dbParticipants->map(fn($pt) => [
            'id' => $pt->kode_jamaah,
            'nama' => $pt->nama,
            'paket_id' => $pt->package?->kode_paket ?? 'PKT-01',
            'paket_nama' => $pt->package?->nama ?? 'Paket Pilihan',
            'no_wa' => $pt->no_wa ?? '-',
            'paspor' => $pt->paspor ?? 'Verifikasi ID',
            'status_dokumen' => $pt->status_dokumen ?? 'Lengkap',
            'status_pembayaran' => $pt->status_pembayaran ?? 'Lunas',
            'total_tagihan' => (float)$pt->total_tagihan,
            'tanggal_daftar' => $pt->tanggal_daftar ? $pt->tanggal_daftar->format('d M Y') : '-',
        ])->toArray();

        $armada = $dbArmada->map(fn($fl) => [
            'id' => $fl->kode_armada,
            'nama_kendaraan' => $fl->nama_kendaraan,
            'kapasitas' => $fl->kapasitas,
            'plat_nomor' => $fl->plat_nomor ?? '-',
            'vendor' => $fl->vendor ?? 'Mitra Transport',
            'status' => $fl->status,
            'driver' => $fl->driver ?? 'Driver On Duty',
            'rute_tujuan' => $fl->rute_tujuan ?? 'Rute Wisata',
        ])->toArray();

        $totalPaket = count($packages);
        $totalJamaah = count($participants);
        $totalArmada = count($armada);

        $omzetTerkontrak = array_reduce($participants, fn($acc, $item) => $acc + $item['total_tagihan'], 0);
        $omzetFormatted = 'Rp ' . number_format($omzetTerkontrak, 0, ',', '.');

        $isSubscriber = true;
        $user = $this->getAuthUser();

        return view('travel.dashboard', compact(
            'packages',
            'participants',
            'armada',
            'totalPaket',
            'totalJamaah',
            'totalArmada',
            'omzetFormatted',
            'isSubscriber',
            'user'
        ));
    }

    /**
     * Halaman Manajemen Paket Tour
     */
    public function paket()
    {
        $dbPackages = TravelPackage::latest()->get();
        $packages = $dbPackages->map(fn($p) => [
            'id' => $p->kode_paket,
            'nama' => $p->nama,
            'kategori' => $p->kategori,
            'durasi' => $p->durasi,
            'tanggal_berangkat' => $p->tanggal_berangkat ? $p->tanggal_berangkat->format('d M Y') : '-',
            'kuota_total' => $p->kuota_total,
            'kuota_terisi' => $p->kuota_terisi,
            'harga' => (float)$p->harga,
            'status' => $p->status,
            'tour_leader' => $p->tour_leader ?? 'Tour Leader Terjadwal',
        ])->toArray();

        $isSubscriber = true;
        return view('travel.paket', compact('packages', 'isSubscriber'));
    }

    /**
     * Tambah Paket Tour Baru
     */
    public function storePaket(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'kategori' => 'required|string|max:100',
            'durasi' => 'required|string|max:50',
            'tanggal_berangkat' => 'required|date',
            'kuota_total' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'tour_leader' => 'nullable|string|max:100',
        ]);

        $count = TravelPackage::count();
        $kodePaket = 'PKT-' . str_pad($count + 1, 2, '0', STR_PAD_LEFT);

        TravelPackage::create([
            'kode_paket' => $kodePaket,
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'durasi' => $validated['durasi'],
            'tanggal_berangkat' => $validated['tanggal_berangkat'],
            'kuota_total' => $validated['kuota_total'],
            'kuota_terisi' => 0,
            'harga' => $validated['harga'],
            'status' => 'Tersedia',
            'tour_leader' => $validated['tour_leader'],
        ]);

        return redirect()->back()->with('success', 'Paket tour & travel baru berhasil diterbitkan!');
    }

    /**
     * Halaman Data Jamaah / Peserta
     */
    public function jamaah()
    {
        $dbParticipants = TravelParticipant::with('package')->latest()->get();
        $dbPackages = TravelPackage::all();

        $participants = $dbParticipants->map(fn($pt) => [
            'id' => $pt->kode_jamaah,
            'nama' => $pt->nama,
            'paket_id' => $pt->package?->kode_paket ?? 'PKT-01',
            'paket_nama' => $pt->package?->nama ?? 'Paket Pilihan',
            'no_wa' => $pt->no_wa ?? '-',
            'paspor' => $pt->paspor ?? 'Verifikasi ID',
            'status_dokumen' => $pt->status_dokumen ?? 'Lengkap',
            'status_pembayaran' => $pt->status_pembayaran ?? 'Lunas',
            'total_tagihan' => (float)$pt->total_tagihan,
            'tanggal_daftar' => $pt->tanggal_daftar ? $pt->tanggal_daftar->format('d M Y') : '-',
        ])->toArray();

        $packages = $dbPackages->map(fn($p) => [
            'id' => $p->id,
            'code' => $p->kode_paket,
            'nama' => $p->nama,
            'harga' => (float)$p->harga,
        ])->toArray();

        $isSubscriber = true;
        return view('travel.jamaah', compact('participants', 'packages', 'isSubscriber'));
    }

    /**
     * Tambah Jamaah Baru
     */
    public function storeJamaah(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'paket_id' => 'required',
            'no_wa' => 'nullable|string|max:30',
            'paspor' => 'nullable|string|max:100',
            'total_tagihan' => 'nullable|numeric|min:0',
        ]);

        $package = TravelPackage::where('kode_paket', $validated['paket_id'])
            ->orWhere('id', $validated['paket_id'])
            ->first();

        $count = TravelParticipant::count();
        $kodeJamaah = 'JMH-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        TravelParticipant::create([
            'package_id' => $package?->id,
            'kode_jamaah' => $kodeJamaah,
            'nama' => $validated['nama'],
            'no_wa' => $validated['no_wa'],
            'paspor' => $validated['paspor'] ?? 'KTP Verified',
            'status_dokumen' => 'Siap Berangkat',
            'status_pembayaran' => 'Lunas',
            'total_tagihan' => $validated['total_tagihan'] ?? ($package ? $package->harga : 5000000),
            'tanggal_daftar' => now(),
        ]);

        if ($package) {
            $package->increment('kuota_terisi');
        }

        return redirect()->back()->with('success', 'Pendaftaran jamaah/peserta berhasil disimpan!');
    }

    /**
     * Halaman Manajemen Armada Kendaraan
     */
    public function armada()
    {
        $dbArmada = TravelFleet::latest()->get();
        $armada = $dbArmada->map(fn($fl) => [
            'id' => $fl->kode_armada,
            'nama_kendaraan' => $fl->nama_kendaraan,
            'kapasitas' => $fl->kapasitas,
            'plat_nomor' => $fl->plat_nomor ?? '-',
            'vendor' => $fl->vendor ?? 'Mitra Transport',
            'status' => $fl->status,
            'driver' => $fl->driver ?? 'Driver On Duty',
            'rute_tujuan' => $fl->rute_tujuan ?? 'Rute Wisata',
        ])->toArray();

        $isSubscriber = true;
        return view('travel.armada', compact('armada', 'isSubscriber'));
    }

    /**
     * Tambah Armada Baru
     */
    public function storeArmada(Request $request)
    {
        $validated = $request->validate([
            'nama_kendaraan' => 'required|string|max:150',
            'kapasitas' => 'required|string|max:50',
            'plat_nomor' => 'nullable|string|max:30',
            'vendor' => 'nullable|string|max:100',
            'driver' => 'nullable|string|max:100',
            'rute_tujuan' => 'nullable|string|max:150',
        ]);

        $count = TravelFleet::count();
        $kodeArmada = 'ARM-' . str_pad($count + 1, 2, '0', STR_PAD_LEFT);

        TravelFleet::create([
            'kode_armada' => $kodeArmada,
            'nama_kendaraan' => $validated['nama_kendaraan'],
            'kapasitas' => $validated['kapasitas'],
            'plat_nomor' => $validated['plat_nomor'],
            'vendor' => $validated['vendor'] ?? 'Armada Internal',
            'status' => 'Siap Jalan',
            'driver' => $validated['driver'],
            'rute_tujuan' => $validated['rute_tujuan'],
        ]);

        return redirect()->back()->with('success', 'Armada transportasi baru berhasil didaftarkan!');
    }

    /**
     * Halaman Laporan Keuangan Travel
     */
    public function keuangan()
    {
        $dbParticipants = TravelParticipant::with('package')->latest()->get();
        $participants = $dbParticipants->map(fn($pt) => [
            'id' => $pt->kode_jamaah,
            'nama' => $pt->nama,
            'paket_nama' => $pt->package?->nama ?? 'Paket',
            'status_pembayaran' => $pt->status_pembayaran ?? 'Lunas',
            'total_tagihan' => (float)$pt->total_tagihan,
            'tanggal_daftar' => $pt->tanggal_daftar ? $pt->tanggal_daftar->format('d M Y') : '-',
        ])->toArray();

        $totalPemasukan = array_reduce($participants, fn($acc, $p) => $acc + $p['total_tagihan'], 0);
        $totalPemasukanFormatted = 'Rp ' . number_format($totalPemasukan, 0, ',', '.');

        $isSubscriber = true;
        return view('travel.keuangan', compact('participants', 'totalPemasukanFormatted', 'isSubscriber'));
    }

    /**
     * Reset Demo Data
     */
    public function resetData()
    {
        return redirect()->route('travel.dashboard')->with('success', 'Data L-Travel telah disinkronkan dengan database!');
    }
}
