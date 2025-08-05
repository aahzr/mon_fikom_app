<?php

       use Illuminate\Support\Facades\Route;
       use App\Http\Controllers\DashboardController;

       Route::get('/', function () {
           if (Auth::check()) {
               return redirect()->route('dashboard');
           }
           return view('auth.login');
       });

       Route::middleware(['auth'])->group(function () {
           Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
           Route::post('/proposal/store', [DashboardController::class, 'storeProposal'])->name('store.proposal');
           Route::post('/laporan/store', [DashboardController::class, 'storeLaporan'])->name('store.laporan');
           Route::post('/luaran/store', [DashboardController::class, 'storeLuaran'])->name('store.luaran');
           Route::post('/keuangan/store', [DashboardController::class, 'storeKeuangan'])->name('store.keuangan');
       });

       require __DIR__.'/auth.php';