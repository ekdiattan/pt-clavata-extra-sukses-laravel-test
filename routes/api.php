<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\AuthController;
use App\Modules\User\Controllers\UserController;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('user',UserController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [UserController::class, 'store']);
