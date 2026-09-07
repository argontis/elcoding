<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$p = DB::table('portofolios')->where('title', 'like', '%LazizMU%')->first();
echo "PORTOFOLIO: " . json_encode($p, JSON_PRETTY_PRINT) . "\n\n";

$m = DB::table('mitras')->where('name', 'like', '%LazizMU%')->first();
echo "MITRA: " . json_encode($m, JSON_PRETTY_PRINT) . "\n\n";

$mou = DB::table('mous')->where('perihal', 'like', '%LazizMU%')->first();
echo "MOU: " . json_encode($mou, JSON_PRETTY_PRINT) . "\n\n";
