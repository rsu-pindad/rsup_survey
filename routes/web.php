<?php

use App\Livewire\Admin\Karyawan\Karyawan;
use App\Livewire\Guest\Register;
use App\Livewire\SuperAdmin\User\User;
use App\Livewire\Admin\Karyawan\KaryawanEdit;
use App\Livewire\Admin\KaryawanProfile\KaryawanProfile;
use App\Livewire\Admin\KaryawanProfile\KaryawanProfileEdit;
use App\Livewire\Admin\Layanan\Layanan;
use App\Livewire\Admin\Layanan\LayananEdit;
use App\Livewire\Admin\LayananRespon\LayananRespon;
use App\Livewire\Admin\LayananRespon\LayananResponEdit;
use App\Livewire\Admin\Penjamin\Penjamin;
use App\Livewire\Admin\Penjamin\PenjaminEdit;
use App\Livewire\Admin\PenjaminLayanan\PenjaminLayanan;
use App\Livewire\Admin\PenjaminLayanan\PenjaminLayananEdit;
use App\Livewire\Admin\Respon\Respon;
use App\Livewire\Admin\Respon\ResponEdit;
use App\Livewire\Admin\RootsAdmin;
use App\Livewire\Admin\SurveyPetugas;
use App\Livewire\Admin\Unit\Unit;
use App\Livewire\Admin\Unit\UnitEdit;
use App\Livewire\Self\UserSetting;
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

    Route::get('/user', User::class)->name('root-super-admin-user');

    Route::get('/karyawan', Karyawan::class)->name('root-karyawan');
    Route::get('/karyawan/edit/{id}', KaryawanEdit::class)->name('root-karyawan-edit');

    Route::get('/karyawan-profile', KaryawanProfile::class)->name('root-karyawan-profile');
    Route::get('/karyawan-profile/edit/{id}', KaryawanProfileEdit::class)->name('root-karyawan-profile-edit');

    Route::get('/unit', Unit::class)->name('root-unit');
    Route::get('/unit/edit/{id}', UnitEdit::class)->name('root-unit-edit');

    Route::get('/penjamin', Penjamin::class)->name('root-penjamin');
    Route::get('/penjamin/edit/{id}', PenjaminEdit::class)->name('root-penjamin-edit');

    Route::get('/layanan', Layanan::class)->name('root-layanan');
    Route::get('/layanan/edit/{id}', LayananEdit::class)->name('root-layanan-edit');

    Route::get('/respon', Respon::class)->name('root-respon');
    Route::get('/respon/edit/{id}', ResponEdit::class)->name('root-respon-edit');

    Route::get('/penjamin-layanan', PenjaminLayanan::class)->name('root-penjamin-layanan');
    Route::get('/penjamin-layanan/edit/{id}', PenjaminLayananEdit::class)->name('root-penjamin-layanan-edit');

    Route::get('/layanan-respon', LayananRespon::class)->name('root-layanan-respon');
    Route::get('/layanan-respon/edit/{id}', LayananResponEdit::class)->name('root-layanan-respon-edit');

    Route::get('/survey', SurveyPetugasPelayanan::class)->name('isi-survey-pelayanan');
    
    Route::get('/petugas/{id}', SurveyPetugas::class)->name('root-survey-petugas');
    
    Route::get('/self', UserSetting::class)->name('root-self');

    // Route::get('survey', function(){
    //     return 'halaman isi survey pelayanan';
    // })->name('isi-survey-pelayanan');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/daftar', Register::class)->name('root-guest');
});
