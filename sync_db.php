<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Create a dedicated SQLite connection that ignores DB_DATABASE from .env
config(['database.connections.sqlite_sync' => [
    'driver' => 'sqlite',
    'database' => database_path('database.sqlite'),
    'foreign_key_constraints' => false,
]]);

$tables = ['mitras', 'program_kursuses', 'portofolios', 'artikels'];

foreach ($tables as $table) {
    echo "Syncing table: {$table}\n";
    
    // Get all records from SQLite
    $records = DB::connection('sqlite_sync')->table($table)->get()->map(function ($item) {
        return (array) $item;
    })->toArray();
    
    if (count($records) > 0) {
        // Clear MySQL table and insert new records
        DB::connection('mysql')->table($table)->truncate();
        DB::connection('mysql')->table($table)->insert($records);
        echo "  - Inserted " . count($records) . " records.\n";
    } else {
        echo "  - No records found.\n";
    }
}

echo "Synchronization complete!\n";
