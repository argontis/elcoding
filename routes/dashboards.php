<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clean\CleanDashboardController;
use App\Http\Controllers\Bengkel\BengkelDashboardController;

/*
|--------------------------------------------------------------------------
| Custom Dashboard Routes Registry
|--------------------------------------------------------------------------
|
| File route khusus ini menyimpan semua endpoint & fitur SaaS L-Clean & L-Garage Bengkel.
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

    // ==========================================
    // DASHBOARD BENGKEL (L-Garage Workshop Portal)
    // ==========================================
    Route::prefix('bengkel')->name('bengkel.')->middleware('bengkel')->group(function () {
        Route::get('/dashboard', [BengkelDashboardController::class, 'index'])->name('dashboard');
        Route::get('/booking', [BengkelDashboardController::class, 'booking'])->name('booking');
        Route::get('/invoice', [BengkelDashboardController::class, 'invoice'])->name('invoice');
        Route::get('/pelanggan', [BengkelDashboardController::class, 'pelanggan'])->name('pelanggan');
        Route::get('/servis', [BengkelDashboardController::class, 'servis'])->name('servis');
        Route::get('/antrean', [BengkelDashboardController::class, 'antrean'])->name('antrean');
    });

    // ==========================================
    // DASHBOARD BIMBEL (EduPulse Academy SaaS)
    // ==========================================
    Route::prefix('bimbel')->name('bimbel.')->middleware('bimbel')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'index'])->name('dashboard');
        Route::get('/siswa', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'siswa'])->name('siswa');
        Route::post('/siswa', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeSiswa'])->name('siswa.store');
        Route::post('/siswa/{id}/broadcast', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'broadcastSiswa'])->name('siswa.broadcast');
        Route::post('/siswa/{id}/delete', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'destroySiswa'])->name('siswa.destroy');
        // Jadwal & Absensi
        Route::get('/jadwal', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'jadwal'])->name('jadwal');
        Route::post('/jadwal/sesi', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeSesi'])->name('jadwal.sesi.store');
        Route::post('/jadwal/roster', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeRoster'])->name('jadwal.roster.store');
        Route::post('/jadwal/absensi/{id}', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'updateAbsensi'])->name('jadwal.absensi.update');
        Route::post('/jadwal/hadir-semua', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'hadirSemua'])->name('jadwal.hadir_semua');
        Route::get('/jadwal/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetJadwal'])->name('jadwal.reset');
        Route::get('/tagihan', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'tagihan'])->name('tagihan');
        Route::post('/tagihan/store', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeTagihan'])->name('tagihan.store');
        Route::post('/tagihan/{id}/bayar', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'bayarTagihan'])->name('tagihan.bayar');
        Route::post('/tagihan/{id}/reminder', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'kirimReminder'])->name('tagihan.reminder');
        Route::post('/tagihan/blast', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'blastTagihan'])->name('tagihan.blast');
        Route::get('/tagihan/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetTagihan'])->name('tagihan.reset');
        Route::get('/materi', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'materi'])->name('materi');
        Route::post('/materi/store', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeMateri'])->name('materi.store');
        Route::post('/materi/generate-soal', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'generateAiSoal'])->name('materi.generate_soal');
        Route::post('/materi/distribusi', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'distribusiMateri'])->name('materi.distribusi');
        Route::get('/materi/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetMateri'])->name('materi.reset');
        Route::get('/ai-tutor', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'aiTutor'])->name('ai_tutor');
        Route::post('/ai-tutor/chat', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'sendChatAiTutor'])->name('ai_tutor.chat');
        Route::post('/ai-tutor/sesi', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeSesiAiTutor'])->name('ai_tutor.sesi.store');
        Route::get('/ai-tutor/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetAiTutor'])->name('ai_tutor.reset');
        Route::get('/progress', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'progress'])->name('progress');
        Route::post('/progress/evaluasi', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeEvaluasi'])->name('progress.evaluasi.store');
        Route::post('/progress/catatan', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storeCatatanPedagogis'])->name('progress.catatan.store');
        Route::post('/progress/kirim-rapor', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'kirimRaporWa'])->name('progress.kirim_rapor');
        Route::get('/progress/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetProgress'])->name('progress.reset');
        // Pengaturan & Konfigurasi Sistem
        Route::get('/pengaturan', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'pengaturan'])->name('pengaturan');
        Route::post('/pengaturan/profil', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'simpanProfilLembaga'])->name('pengaturan.profil.save');
        Route::post('/pengaturan/whatsapp', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'simpanWhatsapp'])->name('pengaturan.whatsapp.save');
        Route::post('/pengaturan/payment', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'simpanPayment'])->name('pengaturan.payment.save');
        Route::post('/pengaturan/ai', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'simpanAiPolicy'])->name('pengaturan.ai.save');
        Route::get('/pengaturan/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetPengaturan'])->name('pengaturan.reset');
        Route::post('/blast-wa', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'blastWa'])->name('blast_wa');
        Route::post('/pendaftaran', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'storePendaftaran'])->name('pendaftaran.store');
        Route::post('/verifikasi/{id}', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'verifikasiPendaftaran'])->name('verifikasi');
        Route::post('/export-laporan', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'exportLaporan'])->name('export_laporan');
        Route::get('/reset', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'resetData'])->name('reset');
        Route::post('/logout', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'logout'])->name('logout');
        Route::get('/logout', [\App\Http\Controllers\Bimbel\BimbelDashboardController::class, 'logout'])->name('logout.get');
    });

    // ==========================================
    // DASHBOARD RESTOHUB (RestoHub OS Culinary Operations)
    // ==========================================
    Route::prefix('resto')->name('resto.')->middleware('resto')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'index'])->name('dashboard');
        Route::get('/kds', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'kds'])->name('kds');
        Route::get('/inventaris', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'inventaris'])->name('inventaris');
        Route::post('/inventaris/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createBahan'])->name('inventaris.create');
        Route::post('/inventaris/delete/{id}', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'deleteBahan'])->name('inventaris.delete');
        Route::get('/member', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'member'])->name('member');
        Route::post('/member/reservasi/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createReservasi'])->name('member.reservasi.create');
        Route::post('/member/reservasi/status/{id}', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'updateReservasiStatus'])->name('member.reservasi.status');
        Route::post('/member/reservasi/delete/{id}', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'deleteReservasi'])->name('member.reservasi.delete');
        Route::post('/member/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createMember'])->name('member.create');
        Route::post('/member/delete/{id}', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'deleteMember'])->name('member.delete');
        Route::get('/marketing', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'marketing'])->name('marketing');
        Route::post('/marketing/campaign/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createCampaign'])->name('marketing.campaign.create');
        Route::post('/marketing/campaign/delete/{id}', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'deleteCampaign'])->name('marketing.campaign.delete');
        Route::post('/marketing/trigger/toggle', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'toggleTrigger'])->name('marketing.trigger.toggle');
        Route::get('/laporan', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'laporan'])->name('laporan');
        Route::post('/laporan/tutup-buku', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'tutupBuku'])->name('laporan.tutup_buku');
        Route::post('/laporan/config', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'saveLaporanConfig'])->name('laporan.config');
        Route::post('/laporan/transaksi/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createTransaksiManual'])->name('laporan.transaksi.create');
        Route::post('/table/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createTable'])->name('table.create');
        Route::post('/table/select', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'selectTable'])->name('table.select');
        Route::post('/table/status', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'updateTableStatus'])->name('table.status');
        Route::post('/menu/create', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'createMenu'])->name('menu.create');
        Route::post('/order/item/add', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'addItem'])->name('order.item.add');
        Route::post('/order/item/remove', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'removeItem'])->name('order.item.remove');
        Route::post('/order/pay', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'processPayment'])->name('order.pay');
        Route::post('/order/discount', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'toggleDiscount'])->name('order.discount');
        Route::post('/order/kds', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'fireKds'])->name('order.kds');
        Route::post('/order/catatan', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'saveCatatanDapur'])->name('order.catatan');
        Route::post('/branch/switch', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'switchBranch'])->name('branch.switch');
        Route::post('/shift/toggle', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'toggleShift'])->name('shift.toggle');
        Route::get('/reset', [\App\Http\Controllers\Resto\RestoDashboardController::class, 'resetData'])->name('reset');
    });

    // ==========================================
    // DASHBOARD TECHFIX PRO (Service Center & Hardware Repair OS)
    // ==========================================
    Route::prefix('techfix')->name('techfix.')->middleware('techfix')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'index'])->name('dashboard');
        Route::get('/tracking-wa', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'trackingWa'])->name('tracking');
        Route::post('/tracking-wa/estimasi', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeEstimasiWa'])->name('tracking.store');
        Route::post('/tracking-wa/{id}/status', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'updateEstimasiStatus'])->name('tracking.status');
        Route::get('/kasir', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'kasir'])->name('kasir');
        Route::post('/kasir/transaksi', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeTransaksi'])->name('kasir.store');
        Route::post('/kasir/garansi', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeGaransi'])->name('kasir.garansi.store');
        Route::get('/kasir/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetKasir'])->name('kasir.reset');
        Route::get('/stok', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'stok'])->name('stok');
        Route::post('/stok/part', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storePartStok'])->name('stok.store');
        Route::get('/stok/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetStok'])->name('stok.reset');
        Route::post('/tiket', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeTiket'])->name('tiket.store');
        Route::post('/tiket/{id}/status', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'updateStatusTiket'])->name('tiket.status');
        Route::post('/tiket/{id}/item', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'addItem'])->name('tiket.item.add');
        Route::post('/branch/switch', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'switchBranch'])->name('branch.switch');
        Route::post('/shift/toggle', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'toggleShift'])->name('shift.toggle');
        Route::get('/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetData'])->name('reset');
        Route::get('/crm', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'crm'])->name('crm');
        Route::post('/crm/customer', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeCustomer'])->name('crm.store');
        Route::post('/crm/unit', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeUnit'])->name('crm.unit.store');
        Route::get('/crm/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetCrm'])->name('crm.reset');
        Route::get('/laporan', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'laporan'])->name('laporan');
        Route::post('/laporan/transaksi', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storeLaporanTransaksi'])->name('laporan.transaksi.store');
        Route::post('/laporan/tutup-buku', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'tutupBuku'])->name('laporan.tutup_buku');
        Route::get('/laporan/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetLaporan'])->name('laporan.reset');
        Route::get('/pengaturan', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'pengaturan'])->name('pengaturan');
        Route::post('/pengaturan/log', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'storePengaturanLog'])->name('pengaturan.log.store');
        Route::get('/pengaturan/reset', [\App\Http\Controllers\Techfix\TechfixDashboardController::class, 'resetPengaturan'])->name('pengaturan.reset');
    });

    // ==========================================
    // DASHBOARD KLINIK (Sistem Manajemen Operasional Klinik)
    // ==========================================
    Route::prefix('klinik')->name('klinik.')->middleware('klinik')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Klinik\KlinikDashboardController::class, 'index'])->name('dashboard');
    });

});

