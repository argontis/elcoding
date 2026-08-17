<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$mou = DB::table('mous')->where('id', 3)->first();
$sections = DB::table('mou_sections')->where('mou_id', 3)->get();
$data = ['mou' => (array) $mou, 'sections' => json_decode(json_encode($sections), true)];
file_put_contents('mou3_data.json', json_encode($data, JSON_PRETTY_PRINT));
