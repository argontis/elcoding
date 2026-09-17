<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "--- PORTOFOLIOS ---\n";
print_r(DB::table('portofolios')->get()->toArray());

echo "\n--- ARTIKELS ---\n";
print_r(DB::table('artikels')->get()->toArray());
