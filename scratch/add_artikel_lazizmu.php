<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Artikel;

// Ensure target dir exists
$destDir = __DIR__.'/../public/gambar/artikel';
if (!file_exists($destDir)) {
    mkdir($destDir, 0777, true);
}

// Copy image to public/gambar/artikel/
$srcImg = __DIR__.'/../public/gambar/portofolio/kerjasama-lazizmu.webp';
$destImg = $destDir.'/kerjasama-lazizmu.webp';
if (file_exists($srcImg)) {
    copy($srcImg, $destImg);
    echo "Image copied to {$destImg}\n";
}

$srcPng = __DIR__.'/../public/gambar/portofolio/kerjasama-lazizmu.png';
$destPng = $destDir.'/kerjasama-lazizmu.png';
if (file_exists($srcPng)) {
    copy($srcPng, $destPng);
    echo "Image copied to {$destPng}\n";
}

// Insert or update Artikel
$artikel = Artikel::updateOrCreate(
    ['title' => 'Kerjasama Pengembangan Sinergis dengan LazizMU'],
    [
        'author' => 'Admin Elcoding',
        'category' => 'Kerjasama',
        'status' => 'Published',
        'published_at' => now()->toDateString(),
        'image_path' => 'gambar/artikel/kerjasama-lazizmu.webp',
        'content' => '<p>Elcoding Academy secara resmi menjalin kerjasama pengembangan sinergis dengan LazizMU. Kerjasama ini bertujuan untuk memperkuat ekosistem digital, mempercepat otomatisasi layanan, serta meningkatkan efisiensi tata kelola teknologi informasi secara berkesinambungan.</p><p>Melalui kolaborasi ini, kedua pihak berkomitmen untuk menghadirkan inovasi solusi perangkat lunak yang andal dan tepat guna untuk mendukung berbagai program operasional LazizMU secara optimal.</p>',
        'updated_at' => now(),
    ]
);

echo "Artikel successfully added/updated! ID: {$artikel->id}\n";
