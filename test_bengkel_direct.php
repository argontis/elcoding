<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $controller = app(\App\Http\Controllers\Bengkel\BengkelDashboardController::class);
    $view = $controller->index();
    echo "Controller index() returned: " . get_class($view) . PHP_EOL;
    $html = $view->render();
    echo "Rendered HTML length: " . strlen($html) . PHP_EOL;
} catch (\Throwable $e) {
    echo "Exception: " . $e->getMessage() . PHP_EOL;
    echo "In " . $e->getFile() . ":" . $e->getLine() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
