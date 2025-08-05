<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
});

require __DIR__.'/auth.php';