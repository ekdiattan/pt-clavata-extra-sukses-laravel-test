<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\AuthController;
use App\Modules\User\Controllers\UserController;
use App\Modules\Lokasi\Controllers\LokasiController;
use App\Modules\Mutasi\Controllers\MutasiController;
use App\Modules\Produk\Controllers\ProdukController;
use App\Modules\ProdukLokasi\Controllers\ProdukLokasiController;

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::resource('user',UserController::class);
    Route::resource('produk',ProdukController::class);
    Route::resource('lokasi',LokasiController::class);
    Route::resource('produk-lokasi',ProdukLokasiController::class);
    Route::resource('mutasi',MutasiController::class);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);
