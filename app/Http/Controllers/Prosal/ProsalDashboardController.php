<?php

namespace App\Http\Controllers\Prosal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProsalUnit;
use App\Models\ProsalTenant;
use App\Models\ProsalMaintenance;
use App\Models\ProsalFinance;

class ProsalDashboardController extends Controller
{
    protected function getAuthUser()
    {
        return auth()->user() ?? (object)[
            'id' => 1,
            'name' => 'Admin Prosal',
            'email' => 'admin@prosal.id',
            'role' => 'admin',
        ];
    }

    /**
     * Dashboard Utama L-Prosal (Overview & Analitik)
     */
    public function index(Request $request)
    {
        $dbUnits = ProsalUnit::latest()->get();
        $dbTenants = ProsalTenant::with('unit')->latest()->get();
        $dbMaintenance = ProsalMaintenance::with('unit')->latest()->get();

        $units = $dbUnits->map(fn($u) => [
            'id' => $u->unit_code,
            'nama' => $u->nama,
            'kategori' => $u->kategori,
            'lokasi' => $u->lokasi,
            'tipe' => $u->tipe,
            'harga' => (float)$u->harga,
            'status' => $u->status,
            'penyewa' => $u->penyewa ?? '-',
            'jatuh_tempo' => $u->jatuh_tempo ? $u->jatuh_tempo->format('d M Y') : '-',
        ])->toArray();

        $tenants = $dbTenants->map(fn($t) => [
            'id' => 'TNT-' . str_pad($t->id, 3, '0', STR_PAD_LEFT),
            'nama' => $t->nama,
            'unit_id' => $t->unit?->unit_code ?? 'UNT-01',
            'unit_nama' => $t->unit?->nama ?? 'Unit Properti',
            'telepon' => $t->no_wa ?? '-',
            'email' => $t->email ?? '-',
            'mulai_sewa' => $t->tgl_masuk ? $t->tgl_masuk->format('d M Y') : '-',
            'akhir_sewa' => $t->tgl_habis ? $t->tgl_habis->format('d M Y') : '-',
            'status_pembayaran' => $t->status_pembayaran ?? 'Lunas',
            'nominal_sewa' => (float)$t->sewa_bulanan,
        ])->toArray();

        $maintenance = $dbMaintenance->map(fn($m) => [
            'id' => $m->tiket_code,
            'unit' => $m->unit?->nama ?? 'Unit Properti',
            'keluhan' => $m->deskripsi_kendala,
            'pelapor' => $m->pelapor,
            'prioritas' => $m->prioritas,
            'status' => $m->status,
            'teknisi' => 'Tim Maintenance',
            'tanggal' => $m->tgl_lapor ? $m->tgl_lapor->format('d M Y') : $m->created_at->format('d M Y'),
        ])->toArray();

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

        $isSubscriber = true;
        $user = $this->getAuthUser();

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
        $dbUnits = ProsalUnit::latest()->get();
        $units = $dbUnits->map(fn($u) => [
            'id' => $u->unit_code,
            'nama' => $u->nama,
            'kategori' => $u->kategori,
            'lokasi' => $u->lokasi,
            'tipe' => $u->tipe,
            'harga' => (float)$u->harga,
            'status' => $u->status,
            'penyewa' => $u->penyewa ?? '-',
            'jatuh_tempo' => $u->jatuh_tempo ? $u->jatuh_tempo->format('d M Y') : '-',
        ])->toArray();

        $isSubscriber = true;
        return view('prosal.unit', compact('units', 'isSubscriber'));
    }

    /**
     * Tambah Unit Baru (disimpan ke Database)
     */
    public function storeUnit(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:200',
            'tipe' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:50',
        ]);

        $count = ProsalUnit::count();
        $unitCode = 'UNT-' . str_pad($count + 1, 2, '0', STR_PAD_LEFT);

        ProsalUnit::create([
            'unit_code' => $unitCode,
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'lokasi' => $validated['lokasi'],
            'tipe' => $validated['tipe'],
            'harga' => $validated['harga'],
            'status' => $validated['status'] ?? 'Tersedia',
            'penyewa' => null,
            'jatuh_tempo' => null,
        ]);

        return redirect()->back()->with('success', 'Unit properti baru berhasil ditambahkan!');
    }

    /**
     * Halaman Manajemen Penyewa / Tenant
     */
    public function penyewa()
    {
        $dbTenants = ProsalTenant::with('unit')->latest()->get();
        $dbUnits = ProsalUnit::all();

        $tenants = $dbTenants->map(fn($t) => [
            'id' => 'TNT-' . str_pad($t->id, 3, '0', STR_PAD_LEFT),
            'nama' => $t->nama,
            'unit_id' => $t->unit?->unit_code ?? 'UNT-01',
            'unit_nama' => $t->unit?->nama ?? 'Unit Properti',
            'telepon' => $t->no_wa ?? '-',
            'email' => $t->email ?? '-',
            'mulai_sewa' => $t->tgl_masuk ? $t->tgl_masuk->format('d M Y') : '-',
            'akhir_sewa' => $t->tgl_habis ? $t->tgl_habis->format('d M Y') : '-',
            'status_pembayaran' => $t->status_pembayaran ?? 'Lunas',
            'nominal_sewa' => (float)$t->sewa_bulanan,
        ])->toArray();

        $units = $dbUnits->map(fn($u) => [
            'id' => $u->id,
            'code' => $u->unit_code,
            'nama' => $u->nama,
        ])->toArray();

        $isSubscriber = true;
        return view('prosal.penyewa', compact('tenants', 'units', 'isSubscriber'));
    }

    /**
     * Tambah Penyewa Baru (disimpan ke Database)
     */
    public function storePenyewa(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'unit_id' => 'required',
            'telepon' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'akhir_sewa' => 'nullable|date',
            'nominal_sewa' => 'nullable|numeric|min:0',
        ]);

        $unit = ProsalUnit::where('unit_code', $validated['unit_id'])
            ->orWhere('id', $validated['unit_id'])
            ->first();

        if ($unit) {
            $unit->update([
                'status' => 'Tersewa',
                'penyewa' => $validated['nama'],
                'jatuh_tempo' => $validated['akhir_sewa'] ?? now()->addYear(),
            ]);
        }

        ProsalTenant::create([
            'unit_id' => $unit?->id,
            'nama' => $validated['nama'],
            'no_wa' => $validated['telepon'],
            'email' => $validated['email'],
            'tgl_masuk' => now(),
            'tgl_habis' => $validated['akhir_sewa'] ?? now()->addYear(),
            'sewa_bulanan' => $validated['nominal_sewa'] ?? ($unit ? $unit->harga : 5000000),
            'deposit' => $validated['nominal_sewa'] ?? ($unit ? $unit->harga : 5000000),
            'status_pembayaran' => 'Lunas',
        ]);

        return redirect()->back()->with('success', 'Data penyewa baru berhasil didaftarkan!');
    }

    /**
     * Halaman Tagihan & Keuangan
     */
    public function keuangan()
    {
        $dbTenants = ProsalTenant::with('unit')->latest()->get();
        $dbUnits = ProsalUnit::all();

        $tenants = $dbTenants->map(fn($t) => [
            'id' => 'TNT-' . str_pad($t->id, 3, '0', STR_PAD_LEFT),
            'nama' => $t->nama,
            'unit_id' => $t->unit?->unit_code ?? 'UNT-01',
            'unit_nama' => $t->unit?->nama ?? 'Unit Properti',
            'telepon' => $t->no_wa ?? '-',
            'email' => $t->email ?? '-',
            'mulai_sewa' => $t->tgl_masuk ? $t->tgl_masuk->format('d M Y') : '-',
            'akhir_sewa' => $t->tgl_habis ? $t->tgl_habis->format('d M Y') : '-',
            'status_pembayaran' => $t->status_pembayaran ?? 'Lunas',
            'nominal_sewa' => (float)$t->sewa_bulanan,
        ])->toArray();

        $units = $dbUnits->map(fn($u) => [
            'id' => $u->id,
            'code' => $u->unit_code,
            'nama' => $u->nama,
            'harga' => (float)$u->harga,
            'status' => $u->status,
        ])->toArray();

        $isSubscriber = true;
        return view('prosal.keuangan', compact('tenants', 'units', 'isSubscriber'));
    }

    /**
     * Halaman Tiket Maintenance & Keluhan
     */
    public function maintenance()
    {
        $dbMaintenance = ProsalMaintenance::with('unit')->latest()->get();
        $dbUnits = ProsalUnit::all();

        $maintenance = $dbMaintenance->map(fn($m) => [
            'id' => $m->tiket_code,
            'unit' => $m->unit?->nama ?? 'Unit Properti',
            'keluhan' => $m->deskripsi_kendala,
            'pelapor' => $m->pelapor,
            'prioritas' => $m->prioritas,
            'status' => $m->status,
            'teknisi' => 'Tim Maintenance',
            'tanggal' => $m->tgl_lapor ? $m->tgl_lapor->format('d M Y') : $m->created_at->format('d M Y'),
        ])->toArray();

        $units = $dbUnits->map(fn($u) => [
            'id' => $u->id,
            'code' => $u->unit_code,
            'nama' => $u->nama,
        ])->toArray();

        $isSubscriber = true;
        return view('prosal.maintenance', compact('maintenance', 'units', 'isSubscriber'));
    }

    /**
     * Buat Tiket Maintenance Baru (disimpan ke Database)
     */
    public function storeMaintenance(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'nullable|string',
            'keluhan' => 'required|string|max:500',
            'pelapor' => 'required|string|max:100',
            'prioritas' => 'nullable|string|max:50',
            'biaya' => 'nullable|numeric|min:0',
        ]);

        $unit = ProsalUnit::where('nama', 'LIKE', '%' . ($validated['unit'] ?? '') . '%')->first();

        ProsalMaintenance::create([
            'unit_id' => $unit?->id,
            'tiket_code' => 'MNT-' . rand(110, 990),
            'pelapor' => $validated['pelapor'],
            'deskripsi_kendala' => $validated['keluhan'],
            'prioritas' => $validated['prioritas'] ?? 'Sedang',
            'biaya' => $validated['biaya'] ?? 250000,
            'status' => 'Dalam Proses',
            'tgl_lapor' => now(),
        ]);

        return redirect()->back()->with('success', 'Tiket keluhan & maintenance berhasil dibuat!');
    }

    /**
     * Reset Demo Data
     */
    public function resetData()
    {
        return redirect()->route('prosal.dashboard')->with('success', 'Data L-Prosal telah disinkronkan dengan database!');
    }
}
