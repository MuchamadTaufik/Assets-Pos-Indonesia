<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DihapuskanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiAssetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => ['auth','role:admin,superadmin']], function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/category-barang', [CategoryBarangController::class, 'index'])->name('category.barang');
    Route::get('/category-barang/create', [CategoryBarangController::class, 'create'])->name('category.barang.create');
    Route::post('/category-barang/store', [CategoryBarangController::class, 'store'])->name('category.barang.store');
    Route::get('/category-barang/edit/{categoryBarang}', [CategoryBarangController::class, 'edit'])->name('category.barang.edit');
    Route::put('/category-barang/update/{categoryBarang}', [CategoryBarangController::class, 'update'])->name('category.barang.update');
    Route::delete('/category-barang/delete/{categoryBarang}', [CategoryBarangController::class, 'destroy'])->name('category.barang.delete');

    Route::get('/lokasi-asset', [LokasiAssetController::class, 'index'])->name('lokasi');
    Route::get('/lokasi-asset/create', [LokasiAssetController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi-asset/store', [LokasiAssetController::class, 'store'])->name('lokasi.store');
    Route::get('/lokasi-asset/edit/{lokasiAsset}', [LokasiAssetController::class, 'edit'])->name('lokasi.edit');
    Route::put('/lokasi-asset/update/{lokasiAsset}', [LokasiAssetController::class, 'update'])->name('lokasi.update');
    Route::delete('/lokasi-asset/delete/{lokasiAsset}', [LokasiAssetController::class, 'destroy'])->name('lokasi.delete');

    Route::get('/asset-berwujud', [AssetsController::class, 'index'])->name('asset.berwujud');
    Route::get('/asset-berwujud/create', [AssetsController::class, 'create'])->name('asset.berwujud.create');
    Route::post('/asset-berwujud/store', [AssetsController::class, 'store'])->name('asset.berwujud.store');
    Route::get('/asset-berwujud/edit/{assets}', [AssetsController::class, 'edit'])->name('asset.berwujud.edit');
    Route::put('/asset-berwujud/update/{assets}', [AssetsController::class, 'update'])->name('asset.berwujud.update');
    Route::delete('/asset-berwujud/delete/{assets}', [AssetsController::class, 'destroy'])->name('asset.berwujud.delete');

    Route::get('/penyusutan', [AssetsController::class, 'penyusutan'])->name('penyusutan');

    Route::get('/asset-dihapuskan', [DihapuskanController::class, 'index'])->name('asset.dihapuskan');
    Route::get('/asset-dihapuskan/create', [DihapuskanController::class, 'create'])->name('asset.dihapuskan.create');
    Route::post('/asset-dihapuskan/store', [DihapuskanController::class, 'store'])->name('asset.dihapuskan.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/download', [LaporanController::class, 'export'])->name('laporan.export');
});

