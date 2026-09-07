<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Portofolio;
use App\Models\Mitra;
use App\Models\Mou;

// 1. Add / Update Portofolio
$portofolio = Portofolio::updateOrCreate(
    ['title' => 'Kerjasama Pengembangan Sinergis dengan LazizMU'],
    [
        'category' => 'Kerjasama',
        'image_path' => 'gambar/portofolio/kerjasama-lazizmu.webp',
        'content' => 'Elcoding Academy menjalin kerjasama strategis dengan LazizMU dalam rangka pengembangan sistem digital sinergis, optimalisasi tata kelola teknologi informasi, dan peningkatan efisiensi layanan secara terpadu.',
        'client' => 'LazizMU',
        'date' => '2026-09-02',
        'updated_at' => now(),
    ]
);
echo "Portofolio added/updated! ID: {$portofolio->id}\n";

// 2. Add / Update Mitra
$mitra = Mitra::updateOrCreate(
    ['name' => 'LazizMU'],
    [
        'logo_path' => 'gambar/portofolio/kerjasama-lazizmu.webp',
        'updated_at' => now(),
    ]
);
echo "Mitra added/updated! ID: {$mitra->id}\n";

// 3. Add / Update MoU
$mou = Mou::updateOrCreate(
    ['perihal' => 'Kerjasama Pengembangan Sinergis dengan LazizMU'],
    [
        'nama_file' => 'MoU Kerjasama LazizMU',
        'nomor_surat' => '002/MOU-ELC/IX/2026',
        'lampiran' => '1 Berkas MoU',
        'tanggal' => '2026-09-02',
        'lokasi' => 'Jakarta',
        'nama_customer' => 'LazizMU',
        'pengantar_surat_type' => 'template',
        'pengantar_surat' => "Dengan hormat,\r\nKami dari Elcoding Academy mengajukan dokumen MoU dan penawaran kerjasama pengembangan sinergis dengan LazizMU.",
        'ketentuan_type' => 'template',
        'ketentuan' => "Waktu pengerjaan sesuai dengan kesepakatan bersama.\r\nHarga dan biaya sudah termasuk pemeliharaan dan sistem pendukung.",
        'grand_total' => 0,
        'created_by' => 'Elcoding Academy',
        'updated_at' => now(),
    ]
);
echo "MoU added/updated! ID: {$mou->id}\n";

// Add section to MoU
DB::table('mou_sections')->where('mou_id', $mou->id)->delete();
$blocks = [
    [
        'type' => 'text',
        'content' => '<p><strong>Kerjasama Pengembangan Sinergis dengan LazizMU</strong></p><p>Dokumentasi penandatanganan dan pembahasan kerjasama strategis antara Elcoding Academy dan LazizMU untuk pengembangan ekosistem digital terpadu.</p>'
    ],
    [
        'type' => 'text',
        'content' => '<p><img src="/gambar/portofolio/kerjasama-lazizmu.webp" alt="Kerjasama Pengembangan Sinergis dengan LazizMU" style="max-width: 100%; height: auto; border-radius: 8px;" /></p>'
    ]
];

DB::table('mou_sections')->insert([
    'mou_id' => $mou->id,
    'title' => 'BAGIAN 1: KERJASAMA PENGEMBANGAN SINERGIS DENGAN LAZIZMU',
    'type' => 'block',
    'content' => json_encode($blocks),
    'order' => 0,
    'created_at' => now(),
    'updated_at' => now(),
]);
echo "MoU Section added!\n";

echo "SUCCESSFULLY ADDED LAZIZMU DATA!\n";
