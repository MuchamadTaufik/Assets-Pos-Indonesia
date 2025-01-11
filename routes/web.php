<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryBarangController;
use App\Http\Controllers\DashboardController;
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
});

