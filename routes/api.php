<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/transaksi', [App\Http\Controllers\TransaksiController::class, 'index']);
Route::post('/transaksi', [App\Http\Controllers\TransaksiController::class, 'store']);
Route::get('/transaksi/{id}', [App\Http\Controllers\TransaksiController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });
    Route::prefix('pelanggan')->group(function () {
        Route::get('/', [App\Http\Controllers\PelangganController::class, 'index']);
        Route::post('/', [App\Http\Controllers\PelangganController::class, 'store']);
        Route::get('/{id}', [App\Http\Controllers\PelangganController::class, 'show']);
        Route::put('/{id}', [App\Http\Controllers\PelangganController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\PelangganController::class, 'destroy']);
    });
});