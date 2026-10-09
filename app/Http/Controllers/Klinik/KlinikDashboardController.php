<?php

namespace App\Http\Controllers\Klinik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KlinikDashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama klinik — data kosong, siap diisi.
     */
    public function index()
    {
        $user = auth()->user();

        // Statistik kosong — akan diisi dari database klinik nantinya
        $stats = [
            'pasien_hari_ini'    => 0,
            'pasien_vs_kemarin'  => '+0%',
            'dalam_antrean'      => 0,
            'avg_tunggu'         => '-',
            'selesai_poli'       => 0,
            'total_poli'         => 0,
            'omset_kasir'        => 'Rp 0',
            'target_persen'      => '0%',
        ];

        // Shift aktif
        $shift = [
            'label'  => 'PAGI',
            'mulai'  => '08:00',
            'selesai'=> '15:00',
        ];

        // Stok farmasi yang menipis — kosong
        $stok_menipis = [];

        // Pasien sedang dilayani — kosong
        $pasien_aktif = null;

        // Daftar dokter jaga — kosong
        $dokter_jaga = [];

        // Aktivitas terkini — kosong
        $aktivitas = [];

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
