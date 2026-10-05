<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::where('email', '!=', '')->first();
if ($user) {
    $hasCourse = \App\Models\Order::where('user_email', $user->email)->whereIn('status', ['paid', 'PAID', 'SETTLED'])->exists();
    $hasEvent = \App\Models\EventOrder::where('user_email', $user->email)->whereIn('status', ['paid', 'PAID', 'SETTLED'])->exists();
    echo "User: {$user->email}\n";
    echo "Has Course: " . ($hasCourse ? 'Yes' : 'No') . "\n";
    echo "Has Event: " . ($hasEvent ? 'Yes' : 'No') . "\n";
}
