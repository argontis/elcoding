<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    DB::statement("ALTER TABLE `artikels` MODIFY `content` LONGTEXT NULL;");
    echo "artikels.content updated to LONGTEXT!\n";
} catch (\Exception $e) {
    echo "Error updating artikels: " . $e->getMessage() . "\n";
}

try {
    DB::statement("ALTER TABLE `portofolios` MODIFY `content` LONGTEXT NULL;");
    echo "portofolios.content updated to LONGTEXT!\n";
} catch (\Exception $e) {
    echo "Error updating portofolios: " . $e->getMessage() . "\n";
}
