<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaporanRegulerController;
use App\Http\Controllers\LaporanObatController;
use App\Http\Controllers\DataInfoObatController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\DataSupplierController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\DataUsulObatController;
use App\Http\Controllers\VerifikasiUsulPengadaanController;
use App\Http\Controllers\PenjualanController;

Route::get('/', function () {
    return redirect()->route('utama');
})->name('home');


//HALAMAN LOGIN
Route::view('/login', 'login')->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('/logout', [LoginController::class, 'actionLogout'])->name('actionLogout');

//HALAMAN UTAMA
Route::get('/utama', [UtamaController::class, 'index'])->name('utama');
Route::get('/utama/search', [UtamaController::class, 'search'])->name('utama.search');

//HALAMAN LAPORAN
Route::get('/laporan-reguler', [LaporanRegulerController::class, 'index'])->name('laporanReguler.index');
Route::post('/laporan-reguler/tampil', [LaporanRegulerController::class, 'tampil'])->name('laporan-reguler.tampil');
Route::get('/laporan-obat', [LaporanObatController::class, 'index'])->name('indexLaporanObat');

//HALAMAN DATA INFO OBAT
Route::get('/info-obat', [DataInfoObatController::class, 'index'])->name('infoObat.index');
Route::post('/info-obat/store', [DataInfoObatController::class, 'store'])->name('infoObat.store');
Route::delete('/info-obat/destroy/{id}', [DataInfoObatController::class, 'destroy'])->name('infoObat.destroy');
Route::get('/info-obat/search', [DataInfoObatController::class, 'search'])->name('infoObat.search');
Route::get('/info-obat/edit/{id}', [DataInfoObatController::class, 'edit'])->name('infoObat.edit');
Route::put('/info-obat/update/{id}', [DataInfoObatController::class, 'update'])->name('infoObat.update');

//HALAMAN DATA SUPPLIER
Route::get('/supplier', [DataSupplierController::class, 'index'])->name('supplier.index');
Route::post('/supplier/store', [DataSupplierController::class, 'store'])->name('supplier.store');
Route::delete('/supplier/destroy/{id}', [DataSupplierController::class, 'destroy'])->name('supplier.destroy');
Route::get('/supplier/edit/{id}', [DataSupplierController::class, 'edit'])->name('supplier.edit');
Route::put('/supplier/update/{id}', [DataSupplierController::class, 'update'])->name('supplier.update');
Route::get('/supplier/search', [DataSupplierController::class, 'search'])->name('supplier.search');

//HALAMAN DATA PENGGUNA
Route::get('/pengguna', [DataPenggunaController::class, 'index'])->name('pengguna.index');
Route::post('/pengguna/store', [DataPenggunaController::class, 'store'])->name('pengguna.store');
Route::get('/pengguna/search', [DataPenggunaController::class, 'search'])->name('pengguna.search');
Route::get('/pengguna/edit/{id}', [DataPenggunaController::class, 'edit'])->name('pengguna.edit');
Route::put('/pengguna/update/{id}', [DataPenggunaController::class, 'update'])->name('pengguna.update');
Route::delete('/pengguna/destroy/{id}', [DataPenggunaController::class, 'destroy'])->name('pengguna.destroy');

//HALAMAN DATA OBAT
Route::get('/obat', [DataObatController::class, 'index'])->name('obat.index');
Route::post('/obat/store', [DataObatController::class, 'store'])->name('obat.store');
Route::get('/obat/search', [DataObatController::class, 'search'])->name('obat.search');
Route::get('/obat/edit/{id}', [DataObatController::class, 'edit'])->name('obat.edit');
Route::put('/obat/update/{id}', [DataObatController::class, 'update'])->name('obat.update');
Route::delete('/obat/destroy/{id}', [DataObatController::class, 'destroy'])->name('obat.destroy');

//HALAMAN DATA PENJUALAN
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::post('/penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
Route::put('/penjualan/update/{id}', [PenjualanController::class, 'update'])->name('penjualan.update');

//HALAMAN DATA USUL OBAT
Route::get('/usul-obat', [DataUsulObatController::class, 'index'])->name('usulObat.index');
Route::post('/usul-obat/store', [DataUsulObatController::class, 'store'])->name('usulObat.store');
Route::get('/usul-obat/search', [DataUsulObatController::class, 'search'])->name('usulObat.search');
Route::get('/usul-obat/edit/{id}', [DataUsulObatController::class, 'edit'])->name('usulObat.edit');
Route::put('/usul-obat/update/{id}', [DataUsulObatController::class, 'update'])->name('usulObat.update');
Route::delete('/usul-obat/destroy/{id}', [DataUsulObatController::class, 'destroy'])->name('usulObat.destroy');

//HALAMAN DATA VERIFIKASI USULAN OBAT
Route::get('/verifikasi-usul-pengadaan', [VerifikasiUsulPengadaanController::class, 'index'])->name('verifikasiUsulPengadaan.index');
Route::put('/verifikasi-usul-pengadaan/update/{id}', [VerifikasiUsulPengadaanController::class, 'update'])->name('verifikasiUsulPengadaan.update');

//ROUTE TEST TAMPILAN UI
// Route::view('/pengguna', 'LamanAdmin.buatDataPengguna')->name('actionPengguna');


//Route::view('/obat', 'LamanAdmin.buatDataObat')->name('actionObat');


//Route::view('/pengadaanobat', 'LamanKepalaGudang.buatPengadaanObat')->name('actionPengadaanObat');


Route::view('/verifikasipengadaanobat', 'LamanApoteker.verifikasiPengadaanObat')->name('actionVerifikasiPengadaanObat');

// Route::view('/laporanReguler', 'LamanPemilik.laporanReguler')->name('actionLaporanReguler');
// Route::view('/laporanObat', 'LamanPemilik.laporanObat')->name('actionLaporanObat');
//Route::view('/keranjang', 'LamanKasir.keranjang')->name('actionkeranjang');


//Route::view('/login', 'login')->name('actionlogin');
