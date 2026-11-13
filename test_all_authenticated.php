<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Mock user without database connection
$user = new User();
$user->id = 1;
$user->name = 'Super Admin';
$user->email = 'admin@elcoding.com';
$user->email_verified_at = now();

// Controllers to test directly
$controllers = [
    'Bengkel' => [
        'class' => \App\Http\Controllers\Bengkel\BengkelDashboardController::class,
        'methods' => [
            'index' => [],
            'booking' => [],
            'pelanggan' => [],
            'servis' => [],
            'antrean' => [],
            'invoice' => [new \Illuminate\Http\Request()]
        ]
    ],
    'Bimbel' => [
        'class' => \App\Http\Controllers\Bimbel\BimbelDashboardController::class,
        'methods' => [
            'index' => [],
            'siswa' => [new \Illuminate\Http\Request()],
            'jadwal' => [new \Illuminate\Http\Request()],
            'tagihan' => [new \Illuminate\Http\Request()],
            'materi' => [new \Illuminate\Http\Request()],
            'aiTutor' => [new \Illuminate\Http\Request()],
            'progress' => [new \Illuminate\Http\Request()],
            'pengaturan' => []
        ]
    ],
    'Restaurant' => [
        'class' => \App\Http\Controllers\Resto\RestoDashboardController::class,
        'methods' => [
            'index' => [new \Illuminate\Http\Request()],
            'kds' => [],
            'inventaris' => [],
            'member' => [],
            'marketing' => [],
            'laporan' => []
        ]
    ],
    'TechFix Pro (Service Center)' => [
        'class' => \App\Http\Controllers\Techfix\TechfixDashboardController::class,
        'methods' => [
            'index' => [],
            'trackingWa' => [new \Illuminate\Http\Request()],
            'kasir' => [],
            'stok' => [],
            'crm' => [new \Illuminate\Http\Request()],
            'laporan' => [new \Illuminate\Http\Request()],
            'pengaturan' => [new \Illuminate\Http\Request()]
        ]
    ]
];

echo "================================================================" . PHP_EOL;
echo "  TESTING ALL CONTROLLER METHODS & VIEW RENDERING ACROSS ROLES  " . PHP_EOL;
echo "================================================================" . PHP_EOL;

$passed = 0;
$failed = 0;

foreach ($controllers as $roleName => $info) {
    echo PHP_EOL . "--- [ROLE: {$roleName}] ---" . PHP_EOL;
    $instance = $app->make($info['class']);
    
    foreach ($info['methods'] as $method => $args) {
        try {
            $response = call_user_func_array([$instance, $method], $args);
            $length = 0;
            if ($response instanceof \Illuminate\View\View) {
                $html = $response->render();
                $length = strlen($html);
                echo " [OK] {$method}() -> View rendered ({$length} bytes)" . PHP_EOL;
                $passed++;
            } elseif ($response instanceof \Illuminate\Http\Response) {
                echo " [OK] {$method}() -> HTTP Response " . $response->getStatusCode() . PHP_EOL;
                $passed++;
            } else {
                echo " [OK] {$method}() -> Returned " . gettype($response) . PHP_EOL;
                $passed++;
            }
        } catch (\Throwable $e) {
            echo " [FAIL] {$method}() -> " . $e->getMessage() . " at " . basename($e->getFile()) . ":" . $e->getLine() . PHP_EOL;
            $failed++;
        }
    }
}

echo PHP_EOL . "================================================================" . PHP_EOL;
echo "FINAL STATUS: {$passed} PASSED, {$failed} FAILED." . PHP_EOL;
echo "================================================================" . PHP_EOL;
