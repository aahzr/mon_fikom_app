<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KualifikasiController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('beranda');
    }
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{section}', [ProfileController::class, 'showSection'])->name('profile.section');
    Route::post('/profile/data-pribadi', [ProfileController::class, 'updateDataPribadi'])->name('profile.data-pribadi.update');
    Route::post('/profile/inpassing', [ProfileController::class, 'updateInpassing'])->name('profile.inpassing.update');
    Route::post('/profile/jabatan-fungsional', [ProfileController::class, 'updateJabatanFungsional'])->name('profile.jabatan-fungsional.update');
    Route::post('/profile/kepangkatan', [ProfileController::class, 'updateKepangkatan'])->name('profile.kepangkatan.update');
    Route::post('/profile/penempatan', [ProfileController::class, 'updatePenempatan'])->name('profile.penempatan.update');
    Route::post('/proposal/store', [DashboardController::class, 'storeProposal'])->name('store.proposal');
    Route::post('/laporan/store', [DashboardController::class, 'storeLaporan'])->name('store.laporan');
    Route::post('/luaran/store', [DashboardController::class, 'storeLuaran'])->name('store.luaran');
    Route::post('/keuangan/store', [DashboardController::class, 'storeKeuangan'])->name('store.keuangan');

    // Route baru untuk menu Kualifikasi
    Route::prefix('kualifikasi')->name('kualifikasi.')->group(function () {
        Route::get('/{section}', [KualifikasiController::class, 'showSection'])->name('section');
        // Route untuk menambah data
        Route::post('/pendidikan-formal/store', [KualifikasiController::class, 'storePendidikanFormal'])->name('pendidikan-formal.store');
        Route::post('/diklat/store', [KualifikasiController::class, 'storeDiklat'])->name('diklat.store');
        Route::post('/riwayat-pekerjaan/store', [KualifikasiController::class, 'storeRiwayatPekerjaan'])->name('riwayat-pekerjaan.store');
        
        // Route untuk mengedit, memperbarui, dan menghapus
        Route::get('/pendidikan-formal/{id}/edit', [KualifikasiController::class, 'editPendidikanFormal'])->name('pendidikan-formal.edit');
        Route::put('/pendidikan-formal/{id}/update', [KualifikasiController::class, 'updatePendidikanFormal'])->name('pendidikan-formal.update');
        Route::delete('/pendidikan-formal/{id}/delete', [KualifikasiController::class, 'deletePendidikanFormal'])->name('pendidikan-formal.delete');

        Route::get('/diklat/{id}/edit', [KualifikasiController::class, 'editDiklat'])->name('diklat.edit');
        Route::put('/diklat/{id}/update', [KualifikasiController::class, 'updateDiklat'])->name('diklat.update');
        Route::delete('/diklat/{id}/delete', [KualifikasiController::class, 'deleteDiklat'])->name('diklat.delete');
        
        Route::get('/riwayat-pekerjaan/{id}/edit', [KualifikasiController::class, 'editRiwayatPekerjaan'])->name('riwayat-pekerjaan.edit');
        Route::put('/riwayat-pekerjaan/{id}/update', [KualifikasiController::class, 'updateRiwayatPekerjaan'])->name('riwayat-pekerjaan.update');
        Route::delete('/riwayat-pekerjaan/{id}/delete', [KualifikasiController::class, 'deleteRiwayatPekerjaan'])->name('riwayat-pekerjaan.delete');
    });
});

require __DIR__.'/auth.php';