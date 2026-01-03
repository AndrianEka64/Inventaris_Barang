<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'lihat']);
    Route::get('/logout', [AuthController::class, 'logout']);
    //crud
    Route::prefix('transaksi')->group(function () {
        Route::get('/terakhir', [DashboardController::class, 'transaksiterakhir']);
        Route::get('/', [TransaksiController::class, 'index']);
        Route::post('/', [TransaksiController::class, 'store']);
        Route::get('/{id}', [TransaksiController::class, 'show']);
        Route::put('/{id}', [TransaksiController::class, 'update']);
        Route::delete('/{id}', [TransaksiController::class, 'destroy']);
    });
    Route::prefix('barang')->group(function () {
        Route::get('/terakhir', [DashboardController::class, 'barangterakhir']);
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });
    Route::prefix('pelanggan')->group(function () {
        Route::get('/terakhir', [DashboardController::class, 'pelangganterakhir']);
        Route::get('/', [PelangganController::class, 'index']);
        Route::post('/', [PelangganController::class, 'store']);
        Route::get('/{id}', [PelangganController::class, 'show']);
        Route::put('/{id}', [PelangganController::class, 'update']);
        Route::delete('/{id}', [PelangganController::class, 'destroy']);
    });
    Route::prefix('pemasok')->group(function () {
        Route::get('/terakhir', [DashboardController::class, 'pemasokterakhir']);
        Route::get('/', [PemasokController::class, 'index']);
        Route::post('/', [PemasokController::class, 'store']);
        Route::get('/{id}', [PemasokController::class, 'show']);
        Route::put('/{id}', [PemasokController::class, 'update']);
        Route::delete('/{id}', [PemasokController::class, 'destroy']);
    });
    Route::prefix('barangmasuk')->group(function () {
        Route::get('/', [BarangMasukController::class, 'index']);
        Route::post('/', [BarangMasukController::class, 'store']);
        Route::get('/{id}', [BarangMasukController::class, 'show']);
        Route::put('/{id}', [BarangMasukController::class, 'update']);
        Route::delete('/{id}', [BarangMasukController::class, 'destroy']);
    });
    Route::prefix('barangkeluar')->group(function () {
        Route::get('/', [BarangKeluarController::class, 'index']);
        Route::post('/', [BarangKeluarController::class, 'store']);
        Route::get('/{id}', [BarangKeluarController::class, 'show']);
        Route::put('/{id}', [BarangKeluarController::class, 'update']);
        Route::delete('/{id}', [BarangKeluarController::class, 'destroy']);
    });
    Route::prefix('stokbarang')->group(function () {
        Route::get('/menipis',[DashboardController::class,'menipis']);
        Route::get('/', [StokBarangController::class, 'index']);
        Route::post('/', [StokBarangController::class, 'store']);
        Route::get('/{id}', [StokBarangController::class, 'show']);
        Route::put('/{id}', [StokBarangController::class, 'update']);
        Route::delete('/{id}', [StokBarangController::class, 'destroy']);
    });
    //total
    Route::prefix('count')->group(function () {
        Route::get('/barang', [DashboardController::class, 'barang']);
        Route::get('/pelanggan', [DashboardController::class, 'pelanggan']);
        Route::get('/pemasok', [DashboardController::class, 'pemasok']);
        Route::get('/transaksi', [DashboardController::class, 'transaksi']);
        Route::get('/barangmasuk', [DashboardController::class, 'barangmasuk']);
        Route::get('/barangkeluar', [DashboardController::class, 'barangkeluar']);
    });
});
