<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$events = [
    [
        'type' => 'bootcamp',
        'title' => 'AI & Machine Learning Essentials',
        'price' => 'Gratis / Free',
        'image_path' => 'gambar/webinar/webinar-ai.jpg',
        'badge_text' => 'RECOMMENDED',
        'duration_or_date' => 'flexible',
        'time' => '19:30 WIB',
    ],
    [
        'type' => 'webinar',
        'title' => 'Modern Cloud & Microservices',
        'price' => 'Gratis / Free',
        'image_path' => 'gambar/webinar/webinar-cloud.jpg',
        'badge_text' => 'UPCOMING',
        'duration_or_date' => '05 Sep 2026',
        'time' => '19:30 WIB',
    ],
    [
        'type' => 'webinar',
        'title' => 'Cybersecurity Fundamentals',
        'price' => 'Gratis / Free',
        'image_path' => 'gambar/webinar/webinar-security.jpg',
        'badge_text' => 'SPECIAL',
        'duration_or_date' => '12 Sep 2026',
        'time' => '19:30 WIB',
    ],
    [
        'type' => 'workshop',
        'title' => 'Web App Production-Ready dgn Next.js 15 & Prisma',
        'price' => 'Rp 199.000',
        'image_path' => 'gambar/workshop/workshop-nextjs.jpg',
        'badge_text' => 'RECOMMENDED',
        'duration_or_date' => '18 Sep 2026',
        'time' => '13:00 WIB',
    ],
    [
        'type' => 'workshop',
        'title' => 'Membuat Scalable Design System di Figma',
        'price' => 'Rp 149.000',
        'image_path' => 'gambar/workshop/workshop-figma.jpg',
        'badge_text' => 'POPULER',
        'duration_or_date' => '20 Sep 2026',
        'time' => '10:00 WIB',
    ],
    [
        'type' => 'workshop',
        'title' => 'Automasi Deployment App Menggunakan Docker',
        'price' => 'Rp 249.000',
        'image_path' => 'gambar/workshop/workshop-devops.jpg',
        'badge_text' => 'TERLARIS',
        'duration_or_date' => '25 Sep 2026',
        'time' => '09:00 WIB',
    ],
];

foreach ($events as $eventData) {
    $eventData['slug'] = \Illuminate\Support\Str::slug($eventData['title']);
    \App\Models\Event::firstOrCreate(
        ['title' => $eventData['title']],
        $eventData
    );
}

echo "Events seeded successfully.\n";
