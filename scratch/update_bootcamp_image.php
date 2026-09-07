<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ProgramKursus;

echo "--- Current Program Kursus Records ---\n";
$programs = ProgramKursus::all();
foreach ($programs as $p) {
    echo "ID: {$p->id} | Title: {$p->title} | Image: {$p->image_path}\n";
}

// Copy user uploaded image
$sourceImage = 'C:\Users\LENOVO\.gemini\antigravity-ide\brain\2832e48d-8b09-4697-b36d-5f36e93170a2\.user_uploaded\media_1788748988923.png';
$targetDir = __DIR__ . '/../public/gambar/aset';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}
$targetImageName = 'bootcamp-fullstack.png';
$targetPath = $targetDir . '/' . $targetImageName;

if (file_exists($sourceImage)) {
    copy($sourceImage, $targetPath);
    echo "\nImage copied to: {$targetPath}\n";
} else {
    echo "\nERROR: Source image not found at {$sourceImage}\n";
}

// Update DB record
$dbImagePath = 'gambar/aset/' . $targetImageName;
$bootcampProgram = ProgramKursus::where('title', 'like', '%Bootcamp%')
    ->orWhere('title', 'like', '%Full Stack%')
    ->first();

if ($bootcampProgram) {
    $bootcampProgram->image_path = $dbImagePath;
    $bootcampProgram->save();
    echo "Updated Program ID {$bootcampProgram->id} ('{$bootcampProgram->title}') image_path to: {$dbImagePath}\n";
} else {
    echo "No matching program found. Creating new Bootcamp program...\n";
    $newProgram = ProgramKursus::create([
        'title' => 'Bootcamp Intensif Full Stack Web Dev',
        'duration' => '4 Bulan',
        'price' => 'Rp2.500.000',
        'badge' => 'Recommended',
        'image_path' => $dbImagePath,
        'features' => "<ul><li>Materi <strong>Full Stack Web Dev</strong></li><li>Pembelajaran <strong>Project Based</strong></li><li>Didampingi <strong>Mentor Expert</strong></li><li>Mendapat <strong>Sertifikat Kompetensi</strong></li></ul>"
    ]);
    echo "Created Program ID {$newProgram->id} with image_path: {$dbImagePath}\n";
}

echo "\n--- Updated Program Kursus Records ---\n";
foreach (ProgramKursus::all() as $p) {
    echo "ID: {$p->id} | Title: {$p->title} | Image: {$p->image_path}\n";
}
