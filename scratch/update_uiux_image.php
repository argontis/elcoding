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
$sourceImage = 'C:\Users\LENOVO\.gemini\antigravity-ide\brain\2832e48d-8b09-4697-b36d-5f36e93170a2\.user_uploaded\media_1788749293711.jpg';
$targetDir = __DIR__ . '/../public/gambar/aset';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}
$targetImageName = 'uiux-design.jpg';
$targetPath = $targetDir . '/' . $targetImageName;

if (file_exists($sourceImage)) {
    copy($sourceImage, $targetPath);
    echo "\nImage copied to: {$targetPath}\n";
} else {
    echo "\nERROR: Source image not found at {$sourceImage}\n";
}

// Update DB record
$dbImagePath = 'gambar/aset/' . $targetImageName;
$uiuxProgram = ProgramKursus::where('title', 'like', '%UI/UX%')
    ->orWhere('title', 'like', '%UI / UX%')
    ->orWhere('title', 'like', '%Mastering Skill%')
    ->first();

if ($uiuxProgram) {
    $uiuxProgram->image_path = $dbImagePath;
    $uiuxProgram->save();
    echo "Updated Program ID {$uiuxProgram->id} ('{$uiuxProgram->title}') image_path to: {$dbImagePath}\n";
} else {
    echo "No matching UI/UX program found.\n";
}

echo "\n--- Updated Program Kursus Records ---\n";
foreach (ProgramKursus::all() as $p) {
    echo "ID: {$p->id} | Title: {$p->title} | Image: {$p->image_path}\n";
}
