<?php

use App\Http\Controllers\DashboardController; // <--- PERBAIKAN: Import Controller Ditambahkan
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ==========================================
// ROUTE PUBLIC (LANDING PAGE)
// ==========================================
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route untuk halaman Program Kursus (Publik / Sebelum Login)
Route::get('/program-kursus', function () {
    return Inertia::render('ProgramKursus');
})->name('program.kursus.public');

// Route untuk halaman Artikel (Publik / Sebelum Login)
Route::get('/artikel-publik', function () {
    return Inertia::render('ArtikelPublic');
})->name('artikel.publik');

Route::get('/tentang-kami-publik', function () {
    return Inertia::render('TentangKamiPublic');
})->name('tentang.kami.public');

Route::get('/kontak-publik', function () {
    return Inertia::render('KontakPublic');
})->name('kontak.publik');

// ==========================================
// ROUTE DASHBOARD & ADMIN AREA
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Route Beranda / Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Route Program Khusus (Admin Area)
    Route::get('/program-khusus', function () {
        return Inertia::render('ProgramKursus/Index');
    })->name('program.index');

    // 3. Route Artikel (Admin Area)
    Route::get('/artikel', function () {
        return Inertia::render('Artikel/Index'); 
    })->name('artikel.index');

    // 4. Route Tentang Kami / Portfolio (Admin Area)
    Route::get('/tentang-kami', function () {
        return Inertia::render('TentangKami/Index');
    })->name('tentang.kami');

    // 5. Route Kontak (Admin Area - opsional jika ada di sidebar)
    Route::get('/kontak', function () {
        return Inertia::render('Kontak/Index');
    })->name('kontak.index');

});

// ==========================================
// ROUTE PROFILE
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';