<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clean\CleanDashboardController;

/*
|--------------------------------------------------------------------------
| Custom Dashboard Routes Registry
|--------------------------------------------------------------------------
|
| File route khusus ini menyimpan semua endpoint & fitur SaaS L-Clean Laundry.
|
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // ==========================================
    // DASHBOARD CLEAN (L-Clean SaaS Laundry Facility)
    // ==========================================
    Route::prefix('clean')->name('clean.')->group(function () {
        Route::get('/dashboard', [CleanDashboardController::class, 'index'])->name('dashboard');
        
        // Interactive Endpoints untuk SaaS L-Clean
        Route::post('/orders', [CleanDashboardController::class, 'storeOrder'])->name('orders.store');
        Route::post('/orders/{id}/status', [CleanDashboardController::class, 'updateStatus'])->name('orders.update_status');
        Route::post('/orders/{id}/whatsapp', [CleanDashboardController::class, 'sendWhatsappNotification'])->name('orders.whatsapp');
        Route::get('/orders/{id}/nota', [CleanDashboardController::class, 'getNotaDigital'])->name('orders.nota');
        Route::post('/customers', [CleanDashboardController::class, 'storeCustomer'])->name('customers.store');
        Route::post('/services', [CleanDashboardController::class, 'storeService'])->name('services.store');
    });

});
