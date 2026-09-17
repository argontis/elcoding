<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use App\Models\Mitra;

$deletedCount = DB::table('mitras')->where('name', 'like', '%LazizMU%')->delete();
echo "Deleted {$deletedCount} row(s) from mitras table.\n";
