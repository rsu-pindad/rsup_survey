<?php

use App\Http\Controllers\Api\Admin\KaryawanController;
use App\Http\Controllers\Api\Admin\KaryawanProfileController;
use App\Http\Controllers\Api\Admin\LayananController;
use App\Http\Controllers\Api\Admin\LayananResponController;
use App\Http\Controllers\Api\Admin\ResponController;
use App\Http\Controllers\Api\Admin\UnitController;
use App\Http\Controllers\Api\Admin\PenjaminController;
use App\Http\Controllers\Api\Admin\PenjaminLayananController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
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
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('karyawan-profile', KaryawanProfileController::class);
    Route::resource('penjamin', PenjaminController::class);
    Route::resource('penjamin-layanan', PenjaminLayananController::class);

    // Route::get('clear/token', function () {
    //     if(Auth::check() && Auth::user()->role === 1) {
    //         Auth::user()->tokens()->delete();
    //     }
    //     return 'Token Cleared';
    // })->middleware('auth');
});
