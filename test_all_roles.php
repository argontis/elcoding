<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$testUrls = [
    '/bengkel/dashboard',
    '/bengkel/booking',
    '/bengkel/pelanggan',
    '/bengkel/servis',
    '/bengkel/antrean',
    '/bimbel/dashboard',
    '/bimbel/siswa',
    '/bimbel/jadwal',
    '/bimbel/tagihan',
    '/bimbel/materi',
    '/bimbel/ai-tutor',
    '/bimbel/progress',
    '/bimbel/pengaturan',
    '/resto/dashboard',
    '/resto/kds',
    '/resto/inventaris',
    '/resto/member',
    '/resto/marketing',
    '/resto/laporan',
    '/techfix/dashboard',
    '/techfix/tracking-wa',
    '/techfix/kasir',
    '/techfix/stok',
    '/techfix/crm',
    '/techfix/laporan',
    '/techfix/pengaturan',
];

echo "Testing route rendering..." . PHP_EOL;
$passed = 0;
$failed = 0;

foreach ($testUrls as $url) {
    try {
        $req = Request::create($url, 'GET');
        $res = $app->handle($req);
        $status = $res->getStatusCode();
        if ($status === 200) {
            echo " [OK] " . $url . PHP_EOL;
            $passed++;
        } else {
            echo " [FAIL: {$status}] " . $url . PHP_EOL;
            $failed++;
        }
    } catch (\Throwable $e) {
        echo " [ERROR] " . $url . " -> " . $e->getMessage() . PHP_EOL;
        $failed++;
    }
}

echo PHP_EOL . "Summary: {$passed} passed, {$failed} failed." . PHP_EOL;
