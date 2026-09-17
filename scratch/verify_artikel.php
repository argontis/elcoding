<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$artikel = DB::table('artikels')->where('title', 'like', '%LazizMU%')->first();
echo "ARTIKEL IN DB:\n" . json_encode($artikel, JSON_PRETTY_PRINT) . "\n";
