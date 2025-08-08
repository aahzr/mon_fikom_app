<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KualifikasiController;
use App\Http\Controllers\PelaksanaanPendidikanController;
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

    // Route untuk menu Kualifikasi
    Route::prefix('kualifikasi')->name('kualifikasi.')->group(function () {
        Route::get('/{section}', [KualifikasiController::class, 'showSection'])->name('section');
        Route::post('/pendidikan-formal/store', [KualifikasiController::class, 'storePendidikanFormal'])->name('pendidikan-formal.store');
        Route::post('/diklat/store', [KualifikasiController::class, 'storeDiklat'])->name('diklat.store');
        Route::post('/riwayat-pekerjaan/store', [KualifikasiController::class, 'storeRiwayatPekerjaan'])->name('riwayat-pekerjaan.store');
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

    // Route baru untuk menu Pelaksanaan Pendidikan
    Route::prefix('pelaksanaan-pendidikan')->name('pelaksanaan-pendidikan.')->group(function () {
        Route::get('/{section}', [PelaksanaanPendidikanController::class, 'showSection'])->name('section');
        Route::post('/pengajaran/store', [PelaksanaanPendidikanController::class, 'storePengajaran'])->name('pengajaran.store');
        Route::get('/pengajaran/{id}/edit', [PelaksanaanPendidikanController::class, 'editPengajaran'])->name('pengajaran.edit');
        Route::put('/pengajaran/{id}/update', [PelaksanaanPendidikanController::class, 'updatePengajaran'])->name('pengajaran.update');
        Route::delete('/pengajaran/{id}/delete', [PelaksanaanPendidikanController::class, 'deletePengajaran'])->name('pengajaran.delete');
        // Rute lainnya untuk 9 submenu lainnya
        Route::post('/bimbingan-mahasiswa/store', [PelaksanaanPendidikanController::class, 'storeBimbinganMahasiswa'])->name('bimbingan-mahasiswa.store');
        Route::get('/bimbingan-mahasiswa/{id}/edit', [PelaksanaanPendidikanController::class, 'editBimbinganMahasiswa'])->name('bimbingan-mahasiswa.edit');
        Route::put('/bimbingan-mahasiswa/{id}/update', [PelaksanaanPendidikanController::class, 'updateBimbinganMahasiswa'])->name('bimbingan-mahasiswa.update');
        Route::delete('/bimbingan-mahasiswa/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteBimbinganMahasiswa'])->name('bimbingan-mahasiswa.delete');
        
        Route::post('/pengujian-mahasiswa/store', [PelaksanaanPendidikanController::class, 'storePengujianMahasiswa'])->name('pengujian-mahasiswa.store');
        Route::get('/pengujian-mahasiswa/{id}/edit', [PelaksanaanPendidikanController::class, 'editPengujianMahasiswa'])->name('pengujian-mahasiswa.edit');
        Route::put('/pengujian-mahasiswa/{id}/update', [PelaksanaanPendidikanController::class, 'updatePengujianMahasiswa'])->name('pengujian-mahasiswa.update');
        Route::delete('/pengujian-mahasiswa/{id}/delete', [PelaksanaanPendidikanController::class, 'deletePengujianMahasiswa'])->name('pengujian-mahasiswa.delete');
        
        Route::post('/bahan-ajar/store', [PelaksanaanPendidikanController::class, 'storeBahanAjar'])->name('bahan-ajar.store');
        Route::get('/bahan-ajar/{id}/edit', [PelaksanaanPendidikanController::class, 'editBahanAjar'])->name('bahan-ajar.edit');
        Route::put('/bahan-ajar/{id}/update', [PelaksanaanPendidikanController::class, 'updateBahanAjar'])->name('bahan-ajar.update');
        Route::delete('/bahan-ajar/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteBahanAjar'])->name('bahan-ajar.delete');
        
        Route::post('/pembinaan-mahasiswa/store', [PelaksanaanPendidikanController::class, 'storePembinaanMahasiswa'])->name('pembinaan-mahasiswa.store');
        Route::get('/pembinaan-mahasiswa/{id}/edit', [PelaksanaanPendidikanController::class, 'editPembinaanMahasiswa'])->name('pembinaan-mahasiswa.edit');
        Route::put('/pembinaan-mahasiswa/{id}/update', [PelaksanaanPendidikanController::class, 'updatePembinaanMahasiswa'])->name('pembinaan-mahasiswa.update');
        Route::delete('/pembinaan-mahasiswa/{id}/delete', [PelaksanaanPendidikanController::class, 'deletePembinaanMahasiswa'])->name('pembinaan-mahasiswa.delete');
        
        Route::post('/visiting-scientist/store', [PelaksanaanPendidikanController::class, 'storeVisitingScientist'])->name('visiting-scientist.store');
        Route::get('/visiting-scientist/{id}/edit', [PelaksanaanPendidikanController::class, 'editVisitingScientist'])->name('visiting-scientist.edit');
        Route::put('/visiting-scientist/{id}/update', [PelaksanaanPendidikanController::class, 'updateVisitingScientist'])->name('visiting-scientist.update');
        Route::delete('/visiting-scientist/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteVisitingScientist'])->name('visiting-scientist.delete');
        
        Route::post('/detasering/store', [PelaksanaanPendidikanController::class, 'storeDetasering'])->name('detasering.store');
        Route::get('/detasering/{id}/edit', [PelaksanaanPendidikanController::class, 'editDetasering'])->name('detasering.edit');
        Route::put('/detasering/{id}/update', [PelaksanaanPendidikanController::class, 'updateDetasering'])->name('detasering.update');
        Route::delete('/detasering/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteDetasering'])->name('detasering.delete');
        
        Route::post('/orasi-ilmiah/store', [PelaksanaanPendidikanController::class, 'storeOrasiIlmiah'])->name('orasi-ilmiah.store');
        Route::get('/orasi-ilmiah/{id}/edit', [PelaksanaanPendidikanController::class, 'editOrasiIlmiah'])->name('orasi-ilmiah.edit');
        Route::put('/orasi-ilmiah/{id}/update', [PelaksanaanPendidikanController::class, 'updateOrasiIlmiah'])->name('orasi-ilmiah.update');
        Route::delete('/orasi-ilmiah/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteOrasiIlmiah'])->name('orasi-ilmiah.delete');
        
        Route::post('/pembimbing-dosen/store', [PelaksanaanPendidikanController::class, 'storePembimbingDosen'])->name('pembimbing-dosen.store');
        Route::get('/pembimbing-dosen/{id}/edit', [PelaksanaanPendidikanController::class, 'editPembimbingDosen'])->name('pembimbing-dosen.edit');
        Route::put('/pembimbing-dosen/{id}/update', [PelaksanaanPendidikanController::class, 'updatePembimbingDosen'])->name('pembimbing-dosen.update');
        Route::delete('/pembimbing-dosen/{id}/delete', [PelaksanaanPendidikanController::class, 'deletePembimbingDosen'])->name('pembimbing-dosen.delete');
        
        Route::post('/tugas-tambahan/store', [PelaksanaanPendidikanController::class, 'storeTugasTambahan'])->name('tugas-tambahan.store');
        Route::get('/tugas-tambahan/{id}/edit', [PelaksanaanPendidikanController::class, 'editTugasTambahan'])->name('tugas-tambahan.edit');
        Route::put('/tugas-tambahan/{id}/update', [PelaksanaanPendidikanController::class, 'updateTugasTambahan'])->name('tugas-tambahan.update');
        Route::delete('/tugas-tambahan/{id}/delete', [PelaksanaanPendidikanController::class, 'deleteTugasTambahan'])->name('tugas-tambahan.delete');
    });
});

require __DIR__.'/auth.php';