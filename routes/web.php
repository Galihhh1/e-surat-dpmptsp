<?php

use App\Http\Controllers\BidangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\ValidasiSuratController;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware(['auth'])->group(function () {

    Route::resource('bidangs', BidangController::class);

    Route::get('/surat-masuks-export-pdf', [SuratMasukController::class, 'exportPdf'])
        ->name('surat-masuks.export-pdf');

    Route::get('/surat-masuks/{suratMasuk}/cetak-disposisi', [SuratMasukController::class, 'cetakDisposisi'])
        ->name('surat-masuks.cetak-disposisi');

    Route::patch('/surat-masuks/{suratMasuk}/status', [SuratMasukController::class, 'updateStatus'])
        ->name('surat-masuks.update-status');

    Route::get('/surat-masuks-export-excel', [SuratMasukController::class, 'exportExcel'])
    ->name('surat-masuks.export-excel');

    Route::resource('surat-masuks', SuratMasukController::class);

    Route::get('/surat-keluars-export-pdf', [SuratKeluarController::class, 'exportPdf'])
        ->name('surat-keluars.export-pdf');

    Route::get('/surat-keluars-export-excel', [SuratKeluarController::class, 'exportExcel'])
    ->name('surat-keluars.export-excel');

    Route::get('/surat-keluars/{suratKeluar}/preview', [SuratKeluarController::class, 'preview'])
        ->name('surat-keluars.preview');

    Route::get('/surat-keluars/{suratKeluar}/cetak-pdf', [SuratKeluarController::class, 'cetakPdf'])
        ->name('surat-keluars.cetak-pdf');

    Route::patch('/surat-keluars/{suratKeluar}/ajukan', [SuratKeluarController::class, 'ajukanPersetujuan'])
        ->name('surat-keluars.ajukan');
    Route::patch('/surat-keluars/{suratKeluar}/setujui', [SuratKeluarController::class, 'setujui'])
        ->name('surat-keluars.setujui');
    Route::patch('/surat-keluars/{suratKeluar}/tolak', [SuratKeluarController::class, 'tolak'])
        ->name('surat-keluars.tolak');
    Route::patch('/surat-keluars/{suratKeluar}/kirim', [SuratKeluarController::class, 'kirim'])
        ->name('surat-keluars.kirim');
    Route::patch('/surat-keluars/{suratKeluar}/selesai', [SuratKeluarController::class, 'selesai'])
        ->name('surat-keluars.selesai');
    Route::patch('/surat-keluars/{suratKeluar}/arsipkan', [SuratKeluarController::class, 'arsipkan'])
        ->name('surat-keluars.arsipkan');

    Route::resource('surat-keluars', SuratKeluarController::class);



    Route::resource('users', UserController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])
    ->name('activity-logs.index'); 
    
    Route::get('/arsip-surat', [ArsipSuratController::class, 'index'])
    ->name('arsip-surat.index');

    Route::patch('/arsip-surat/surat-masuk/{suratMasuk}/restore', [ArsipSuratController::class, 'restoreSuratMasuk'])
    ->name('arsip-surat.restore-surat-masuk');

    Route::patch('/arsip-surat/surat-keluar/{suratKeluar}/restore', [ArsipSuratController::class, 'restoreSuratKeluar'])
    ->name('arsip-surat.restore-surat-keluar');

    Route::get('/arsip-surat', [ArsipSuratController::class, 'index'])
    ->name('arsip-surat.index');

    Route::get('/validasi-surat', [ValidasiSuratController::class, 'index'])
    ->name('validasi-surat.index');

    Route::post('/validasi-surat', [ValidasiSuratController::class, 'cek'])
    ->name('validasi-surat.cek');

});

require __DIR__.'/auth.php';