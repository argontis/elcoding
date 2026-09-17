<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $mous = DB::table('mous')->get();
    echo "MOUS COUNT: " . count($mous) . "\n";
    foreach ($mous as $m) {
        echo "ID: {$m->id} | File: {$m->nama_file} | Customer: {$m->nama_customer} | Perihal: {$m->perihal}\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
