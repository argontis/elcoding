<?php
$src = __DIR__ . '/../.user_uploaded/media_1788749608382.jpg';
if (!file_exists($src)) {
    $src = 'C:/Users/LENOVO/.gemini/antigravity-ide/brain/2832e48d-8b09-4697-b36d-5f36e93170a2/.user_uploaded/media_1788749608382.jpg';
}
$dst = __DIR__ . '/../public/gambar/aset/digital-marketing.jpg';
copy($src, $dst);

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\ProgramKursus::find(3);
if ($p) {
    $p->image_path = 'gambar/aset/digital-marketing.jpg';
    $p->save();
    echo "SUCCESS: " . $p->title . " => " . $p->image_path;
}
