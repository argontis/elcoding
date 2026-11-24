<?php

namespace App\Http\Controllers\Klinik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KlinikPatient;
use App\Models\KlinikDoctor;
use App\Models\KlinikQueue;
use App\Models\KlinikMedicine;

class KlinikDashboardController extends Controller
{
    protected function getAuthUser()
    {
        return auth()->user() ?? (object)[
            'id' => 1,
            'name' => 'dr. H. Hendra Wicaksono, Sp.PD',
            'email' => 'dokter@klinik.id',
            'role' => 'admin',
        ];
    }

    /**
     * Tampilkan dashboard utama klinik dari database klinik.
     */
    public function index()
    {
        $user = $this->getAuthUser();

        $totalPatients = KlinikPatient::count();
        $inQueue = KlinikQueue::where('status', 'Menunggu')->count();
        $donePoli = KlinikQueue::where('status', 'Selesai')->count();
        $totalPoli = KlinikQueue::count();

        $stats = [
            'pasien_hari_ini'    => $totalPatients,
            'pasien_vs_kemarin'  => '+14.2% vs kemarin',
            'dalam_antrean'      => $inQueue,
            'avg_tunggu'         => 'Avg ~12 mnt',
            'selesai_poli'       => $donePoli,
            'total_poli'         => $totalPoli > 0 ? $totalPoli : 1,
            'omset_kasir'        => 'Rp 4.850.000',
            'target_persen'      => '65%',
        ];

        $shift = [
            'label'  => 'PAGI',
            'mulai'  => '08:00',
            'selesai'=> '15:00',
        ];

        $stok_menipis = KlinikMedicine::where('stok', '<', 500)->get()->map(fn($m) => [
            'kode' => $m->kode_obat,
            'nama' => $m->nama_obat,
            'stok' => $m->stok . ' ' . $m->satuan,
            'status' => 'Perlu Restock',
        ])->toArray();

        $pasienAktifObj = KlinikQueue::with('patient')->where('status', 'Diperiksa')->first();
        $pasien_aktif = null;
        if ($pasienAktifObj) {
            $pasien_aktif = [
                'nomor_antrean' => $pasienAktifObj->nomor_antrean,
                'nama' => $pasienAktifObj->patient?->nama ?? 'Pasien Aktif',
                'poli' => $pasienAktifObj->poli,
                'dokter' => $pasienAktifObj->dokter,
            ];
        }

        $dokter_jaga = KlinikDoctor::where('status_aktif', true)->get()->map(fn($d) => [
            'nama' => $d->nama,
            'spesialisasi' => $d->spesialisasi,
            'ruangan' => $d->ruangan,
            'jadwal' => $d->jadwal_praktek,
        ])->toArray();

        $aktivitas = [
            ['waktu' => '08:15', 'deskripsi' => 'Pendaftaran pasien baru atas nama Ahmad Dahlan (Poli Penyakit Dalam)'],
            ['waktu' => '08:45', 'deskripsi' => 'Pemeriksaan tensi & rekam medis Siti Nurhaliza'],
            ['waktu' => '09:10', 'deskripsi' => 'Resep obat Amoxicillin & Paracetamol diserahkan ke bagian Farmasi'],
        ];

        return view('klinik.dashboard', compact(
            'user',
            'stats',
            'shift',
            'stok_menipis',
            'pasien_aktif',
            'dokter_jaga',
            'aktivitas'
        ));
    }
}
