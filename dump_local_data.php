<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$tables = [
    'users',
    'layanans',
    'layanan_orders',
    'events',
    'event_orders',
    'orders',
    'program_kursuses',
    'pkl_profiles',
    'pkl_tasks',
    'pkl_quizzes',
    'pkl_invoices',
    'pkl_portfolios',
    'pkl_certificates',
    'pkl_histories',
    'mitras',
    'portofolios',
    'kategori_portofolios',
    'artikels',
    'settings',
    'mous',
    'mou_items',
    'mou_sections'
];

$sqlDump = "-- Local Data Export Dump\n";
$sqlDump .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        continue;
    }

    $rows = DB::table($table)->get();
    if ($rows->isEmpty()) {
        continue;
    }

    $sqlDump .= "-- Table: {$table}\n";
    foreach ($rows as $row) {
        $array = (array) $row;
        $keys = array_map(fn($k) => "`{$k}`", array_keys($array));
        $values = array_map(function ($val) {
            if ($val === null) return "NULL";
            $escaped = addslashes($val);
            return "'{$escaped}'";
        }, array_values($array));

        $sqlDump .= "INSERT INTO `{$table}` (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ");\n";
    }
    $sqlDump .= "\n";
}

file_put_contents(__DIR__ . '/database_local_data.sql', $sqlDump);
echo "Successfully dumped local data into database_local_data.sql (" . strlen($sqlDump) . " bytes)\n";
