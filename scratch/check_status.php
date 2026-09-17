<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$mitraCount = DB::table('mitras')->where('name', 'like', '%LazizMU%')->count();
$portoCount = DB::table('portofolios')->where('title', 'like', '%LazizMU%')->count();
$mouCount = DB::table('mous')->where('perihal', 'like', '%LazizMU%')->count();

echo "Mitra LazizMU count: {$mitraCount}\n";
echo "Portofolio LazizMU count: {$portoCount}\n";
echo "MoU LazizMU count: {$mouCount}\n";
