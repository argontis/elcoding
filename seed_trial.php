<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$programData = [
    'title' => 'Trial Class: Pengenalan Coding',
    'duration' => '1 Pertemuan',
    'price' => 'Gratis',
    'price_amount' => 0,
    'badge' => 'NEW',
    'image_path' => 'gambar/program/trial-class.jpg',
    'theme_color' => 'theme-3',
    'description' => 'Ikuti Trial Class Gratis ini untuk merasakan pengalaman belajar coding secara langsung. Anda akan dibimbing membuat project sederhana dari nol, mengenal dasar-dasar pemrograman, dan berdiskusi langsung dengan mentor kami.',
    'features' => '<ul><li><i class="fas fa-check-circle"></i> Sesi Live Mentoring</li><li><i class="fas fa-check-circle"></i> Modul Pengenalan Coding</li><li><i class="fas fa-check-circle"></i> E-Certificate Kehadiran</li><li><i class="fas fa-check-circle"></i> Tanya Jawab Karir IT</li></ul>',
];

\App\Models\ProgramKursus::updateOrCreate(
    ['title' => $programData['title']],
    $programData
);

echo "Trial Class Program seeded successfully.\n";
