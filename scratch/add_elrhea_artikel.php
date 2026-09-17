<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Artikel;

$title = 'Training & Pelatihan Website Elrhea';

$content = '<p><strong>Elcoding Academy</strong> sukses menyelenggarakan program <em>Training &amp; Pelatihan Website Elrhea</em> yang berlangsung pada tanggal 21 hingga 22 Juli 2026 di Semarang.</p>'
         . '<p>Kegiatan pelatihan ini dirancang untuk memberikan pemahaman mendalam serta keterampilan praktis dalam pengolahan, pengelolaan, dan pengoperasian website secara mandiri dan profesional. Peserta dibimbing langsung oleh tim instruktur berpengalaman dari Elcoding Academy.</p>'
         . '<p style="text-align: center; margin: 25px 0;"><img src="/gambar/artikel/training-pelatihan-elrhea-2.webp" alt="Dokumentasi Pelatihan Website Elrhea" style="max-width: 100%; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);" /></p>'
         . '<p>Selama dua hari penuh, peserta antusias mengikuti rangkaian materi mulai dari pengenalan struktur pengelolaan sistem, manajemen konten, hingga otomatisasi serta pemeliharaan keandalan sistem website. Diharapkan pelatihan ini mampu meningkatkan efisiensi dan kapasitas digital secara berkelanjutan.</p>';

$artikel = Artikel::updateOrCreate(
    ['title' => $title],
    [
        'author' => 'Admin Elcoding',
        'category' => 'Edukasi',
        'status' => 'Published',
        'published_at' => '2026-07-22',
        'image_path' => 'gambar/artikel/training-pelatihan-elrhea-1.webp',
        'content' => $content,
        'updated_at' => now(),
    ]
);

echo "Elrhea Artikel added/updated successfully! ID: {$artikel->id}\n";
