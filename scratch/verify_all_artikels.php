<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$artikels = DB::table('artikels')->where('status', 'Published')->get();
echo "TOTAL PUBLISHED ARTIKELS: " . count($artikels) . "\n\n";

foreach ($artikels as $a) {
    echo "ID: {$a->id} | Title: {$a->title} | Category: {$a->category} | Image: {$a->image_path} | Date: {$a->published_at}\n";
}
