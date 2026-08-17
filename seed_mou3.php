<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Read JSON data
$data = json_decode(file_get_contents('mou3_data.json'), true);

DB::table('mous')->updateOrInsert(['id' => $data['mou']['id']], $data['mou']);

foreach ($data['sections'] as $sec) {
    DB::table('mou_sections')->updateOrInsert(['id' => $sec['id']], $sec);
}

echo "MoU 3 data imported successfully!\n";
