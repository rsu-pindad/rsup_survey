<?php

use App\Http\Controllers\Api\Admin\LayananController;
use App\Http\Controllers\Api\Admin\LayananResponController;
use App\Http\Controllers\Api\Admin\ResponController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "api" middleware group. Make something great!
 * |
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('layanan', LayananController::class);
    Route::resource('respon', ResponController::class);
    Route::resource('layanan-respon', LayananResponController::class);
});
