<?php

use App\Livewire\Admin\Karyawan;
use App\Livewire\Admin\KaryawanProfile;
use App\Livewire\Admin\Layanan;
use App\Livewire\Admin\LayananRespon;
use App\Livewire\Admin\Penjamin;
use App\Livewire\Admin\PenjaminLayanan;
use App\Livewire\Admin\Respon;
use App\Livewire\Admin\RootsAdmin;
use App\Livewire\Admin\SurveyPetugas;
use App\Livewire\Admin\Unit;
use App\Livewire\Auth\Login;
use App\Livewire\Roots;
use App\Livewire\SurveyPetugasPelayanan;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::middleware(['auth'])->group(function () {
    Route::get('/', Roots::class)->name('roots-dashboard');
    Route::get('/logout', [Roots::class, 'logout'])->name('logout');
    Route::get('/sdm', RootsAdmin::class)->name('sdm');

    Route::get('/karyawan', Karyawan::class)->name('root-karyawan');
    Route::get('/karyawan-profile', KaryawanProfile::class)->name('root-karyawan-profile');
    Route::get('/unit', Unit::class)->name('root-unit');
    Route::get('/penjamin', Penjamin::class)->name('root-penjamin');
    Route::get('/layanan', Layanan::class)->name('root-layanan');
    Route::get('/respon', Respon::class)->name('root-respon');
    Route::get('/penjamin-layanan', PenjaminLayanan::class)->name('root-penjamin-layanan');
    Route::get('/layanan-respon', LayananRespon::class)->name('root-layanan-respon');

    Route::get('/survey', SurveyPetugasPelayanan::class)->name('isi-survey-pelayanan');
    Route::get('/petugas/{id}', SurveyPetugas::class)->name('root-survey-petugas');
    // Route::get('survey', function(){
    //     return 'halaman isi survey pelayanan';
    // })->name('isi-survey-pelayanan');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
});
