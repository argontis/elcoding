<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProgramKursusController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChatController;

Route::get('/clear-cache-all', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Semua cache (termasuk view dan route) berhasil dibersihkan! Silakan kembali ke panel admin dan refresh (F5).';
});

Route::post('/chat-gemini', [ChatController::class, 'askGemini']);
// ==========================================
// ROUTE SEO
// ==========================================
Route::get('/sitemap.xml', function () {
    $layanans = \App\Models\Layanan::all();
    $programs = \App\Models\ProgramKursus::all();
    $portofolios = \App\Models\Portofolio::all();
    $artikels = \App\Models\Artikel::where('status', 'Published')->get();

    return response()->view('sitemap', [
        'layanans' => $layanans,
        'programs' => $programs,
        'portofolios' => $portofolios,
        'artikels' => $artikels,
    ])->header('Content-Type', 'text/xml');
});

// ==========================================
// ROUTE PUBLIC (LANDING PAGE - BLADE)
// ==========================================
Route::get('/', function () {
    $mitras = \App\Models\Mitra::oldest()->get();
    $programs = \App\Models\ProgramKursus::oldest()->take(3)->get();
    $portofolios = \App\Models\Portofolio::oldest()->take(3)->get();
    $artikels = \App\Models\Artikel::where('status', 'Published')->oldest()->take(3)->get();
    return view('welcome', compact('mitras', 'programs', 'portofolios', 'artikels'));
});

Route::get('/layanan', function () {
    $layanans = \App\Models\Layanan::latest()->get();
    return view('layanan', compact('layanans')); 
});
Route::get('/layanan/detail/{slug}', function ($slug) {
    $layanan = \App\Models\Layanan::where('slug', $slug)->firstOrFail();
    return view('detail-layanan', compact('layanan')); 
});

Route::post('/layanan/{id}/checkout', [\App\Http\Controllers\CheckoutLayananController::class, 'checkout']);
Route::get('/layanan/payment/success', [\App\Http\Controllers\CheckoutLayananController::class, 'paymentSuccess']);
Route::post('/xendit/layanan/callback', [\App\Http\Controllers\CheckoutLayananController::class, 'callback']);


Route::get('/tentang-kami', function () {
    $mitras = \App\Models\Mitra::oldest()->get();
    return view('tentang-kami', compact('mitras'));
});

Route::get('/program-kursus', function () {
    $programs = \App\Models\ProgramKursus::oldest()->paginate(9);
    return view('program-kursus', compact('programs'));
});

Route::get('/event-webinar', function () {
    return view('event-webinar');
});

Route::get('/program-kursus/{id}', [ProgramKursusController::class, 'show']);
Route::post('/program-kursus/{id}/checkout', [ProgramKursusController::class, 'checkout']);
Route::get('/payment/success', [ProgramKursusController::class, 'paymentSuccess']);
Route::post('/xendit/callback', [ProgramKursusController::class, 'callback']);

Route::get('/portofolio', function () {
    $portofolios = \App\Models\Portofolio::latest()->paginate(9);
    return view('portofolio', compact('portofolios'));
});

Route::get('/portofolio/{id}', function ($id) {
    $portofolio = \App\Models\Portofolio::findOrFail($id);
    return view('portofolio-detail', compact('portofolio'));
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
    Route::redirect('/dashboard', '/admin/mitra')->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::redirect('/', '/admin/mitra');
        Route::get('/aktivitas', [AdminController::class, 'aktivitas']);
        
        // Layanan CRUD
        Route::get('/layanan', [\App\Http\Controllers\Admin\LayananController::class, 'index']);
        Route::get('/layanan/create', [\App\Http\Controllers\Admin\LayananController::class, 'create']);
        Route::post('/layanan', [\App\Http\Controllers\Admin\LayananController::class, 'store']);
        Route::get('/layanan/{id}/edit', [\App\Http\Controllers\Admin\LayananController::class, 'edit']);
        Route::put('/layanan/{id}', [\App\Http\Controllers\Admin\LayananController::class, 'update']);
        Route::delete('/layanan/{id}', [\App\Http\Controllers\Admin\LayananController::class, 'destroy']);
        
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

        // Portofolio CRUD
        Route::get('/portofolio', [AdminController::class, 'portofolio']);
        Route::get('/portofolio/create', [AdminController::class, 'createPortofolio']);
        Route::post('/portofolio', [AdminController::class, 'storePortofolio']);
        Route::get('/portofolio/{id}/edit', [AdminController::class, 'editPortofolio']);
        Route::put('/portofolio/{id}', [AdminController::class, 'updatePortofolio']);
        Route::delete('/portofolio/{id}', [AdminController::class, 'destroyPortofolio']);

        // Kategori Portofolio CRUD
        Route::get('/kategori-portofolio', [AdminController::class, 'kategoriPortofolio']);
        Route::post('/kategori-portofolio', [AdminController::class, 'storeKategoriPortofolio']);
        Route::put('/kategori-portofolio/{id}', [AdminController::class, 'updateKategoriPortofolio']);
        Route::delete('/kategori-portofolio/{id}', [AdminController::class, 'destroyKategoriPortofolio']);
        // Artikel CRUD
        Route::get('/artikel', [AdminController::class, 'artikel']);
        Route::get('/artikel/create', [AdminController::class, 'createArtikel']);
        Route::post('/artikel', [AdminController::class, 'storeArtikel']);
        Route::get('/artikel/{id}/edit', [AdminController::class, 'editArtikel']);
        Route::put('/artikel/{id}', [AdminController::class, 'updateArtikel']);
        Route::delete('/artikel/{id}', [AdminController::class, 'destroyArtikel']);

        // Pengaturan Situs
        Route::get('/settings', [AdminController::class, 'settings']);
        Route::post('/settings', [AdminController::class, 'updateSettings']);
        
        // MoU
        Route::get('/mou', [\App\Http\Controllers\Admin\MouController::class, 'index']);
        Route::get('/mou/create', [\App\Http\Controllers\Admin\MouController::class, 'create']);
        Route::post('/mou', [\App\Http\Controllers\Admin\MouController::class, 'store']);
        Route::get('/mou/{id}/edit', [\App\Http\Controllers\Admin\MouController::class, 'edit']);
        Route::put('/mou/{id}', [\App\Http\Controllers\Admin\MouController::class, 'update']);
        Route::delete('/mou/{id}', [\App\Http\Controllers\Admin\MouController::class, 'destroy']);
        Route::get('/mou/{id}/pdf', [\App\Http\Controllers\Admin\MouController::class, 'downloadPdf']);

        // Transaksi & Pembayaran Kursus
        Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index']);
        Route::put('/orders/{id}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus']);
        Route::delete('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy']);
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