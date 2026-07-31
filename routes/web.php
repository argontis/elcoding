<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ==========================================
// ROUTE PUBLIC (LANDING PAGE - BLADE)
// ==========================================
Route::get('/', function () {
    $mitras = \App\Models\Mitra::latest()->get();
    $programs = \App\Models\ProgramKursus::latest()->take(3)->get();
    $artikels = \App\Models\Artikel::where('status', 'Published')->latest()->take(3)->get();
    return view('welcome', compact('mitras', 'programs', 'artikels'));
});

Route::get('/tentang-kami', function () {
    $mitras = \App\Models\Mitra::latest()->get();
    return view('tentang-kami', compact('mitras'));
});

Route::get('/program-kursus', function () {
    $programs = \App\Models\ProgramKursus::latest()->paginate(9);
    return view('program-kursus', compact('programs'));
});



Route::get('/artikel', function () {
    $artikels = \App\Models\Artikel::where('status', 'Published')->latest()->paginate(9);
    return view('artikel', compact('artikels'));
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/artikel/{id}', function ($id) {
    $artikel = \App\Models\Artikel::findOrFail($id);
    return view('artikel-detail', compact('artikel'));
});



// ==========================================
// ROUTE DASHBOARD & ADMIN AREA (REACT)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Route Beranda / Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard']);
        Route::get('/aktivitas', [AdminController::class, 'aktivitas']);
        
        // Mitra CRUD
        Route::get('/mitra', [AdminController::class, 'mitra']);
        Route::get('/mitra/create', [AdminController::class, 'createMitra']);
        Route::post('/mitra', [AdminController::class, 'storeMitra']);
        Route::get('/mitra/{id}/edit', [AdminController::class, 'editMitra']);
        Route::put('/mitra/{id}', [AdminController::class, 'updateMitra']);
        Route::delete('/mitra/{id}', [AdminController::class, 'destroyMitra']);

        // Program Kursus CRUD
        Route::get('/program-kursus', [AdminController::class, 'programKursus']);
        Route::get('/program-kursus/create', [AdminController::class, 'createProgram']);
        Route::post('/program-kursus', [AdminController::class, 'storeProgram']);
        Route::get('/program-kursus/{id}/edit', [AdminController::class, 'editProgram']);
        Route::put('/program-kursus/{id}', [AdminController::class, 'updateProgram']);
        Route::delete('/program-kursus/{id}', [AdminController::class, 'destroyProgram']);



        // Artikel CRUD
        Route::get('/artikel', [AdminController::class, 'artikel']);
        Route::get('/artikel/create', [AdminController::class, 'createArtikel']);
        Route::post('/artikel', [AdminController::class, 'storeArtikel']);
        Route::get('/artikel/{id}/edit', [AdminController::class, 'editArtikel']);
        Route::put('/artikel/{id}', [AdminController::class, 'updateArtikel']);
        Route::delete('/artikel/{id}', [AdminController::class, 'destroyArtikel']);
    });
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