<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiController::class, 'index']);
        Route::post('/', [TransaksiController::class, 'store']);
        Route::get('/{id}', [TransaksiController::class, 'show']);
        Route::delete('/{id}', [TransaksiController::class, 'destroy']);
    });
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });
    Route::prefix('pelanggan')->group(function () {
        Route::get('/', [PelangganController::class, 'index']);
        Route::post('/', [PelangganController::class, 'store']);
        Route::get('/{id}', [PelangganController::class, 'show']);
        Route::put('/{id}', [PelangganController::class, 'update']);
        Route::delete('/{id}', [PelangganController::class, 'destroy']);
    });
    Route::prefix('pemasok')->group(function () {
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
    Route::prefix('barangkeluar')->group(function(){
        Route::get('/', [BarangKeluarController::class, 'index']);
        Route::post('/', [BarangKeluarController::class, 'store']);
        Route::get('/{id}', [BarangKeluarController::class, 'show']);
        Route::put('/{id}', [BarangKeluarController::class, 'update']);
        Route::delete('/{id}', [BarangKeluarController::class, 'destroy']);
    });
});
