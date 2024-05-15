<?php

use App\Livewire\Admin\Karyawan\Karyawan;
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
use App\Livewire\Admin\Unit\UnitProfil\UnitProfil;
use App\Livewire\Admin\Unit\Unit;
use App\Livewire\Admin\Unit\UnitEdit;
use App\Livewire\Admin\RootsAdmin;
use App\Livewire\Admin\SurveyPetugas;
use App\Livewire\Auth\Login;
use App\Livewire\Guest\Register;
use App\Livewire\Sdm\Laporan;
use App\Livewire\Self\UserSetting;
use App\Livewire\SuperAdmin\RolePermission\Permission;
use App\Livewire\SuperAdmin\RolePermission\PermissionEdit;
use App\Livewire\SuperAdmin\RolePermission\Role;
use App\Livewire\SuperAdmin\RolePermission\RoleEdit;
use App\Livewire\SuperAdmin\User\User;
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

    Route::middleware('role:super-admin')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', User::class)->name('root-super-admin-user');
        });
        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', Permission::class)->name('root-super-admin-permission');
            Route::get('/edit/{id}', PermissionEdit::class)->name('root-super-admin-permission-edit');
        });
        Route::group(['prefix' => 'role'], function () {
            Route::get('/', Role::class)->name('root-super-admin-role');
            Route::get('/edit/{id}', RoleEdit::class)->name('root-super-admin-role-edit');
        });
    });

    Route::middleware('role:sdm|super-admin')->group(function () {
        Route::group(['prefix' => 'karyawan'], function () {
            Route::get('/', Karyawan::class)->name('root-karyawan');
            Route::get('/edit/{id}', KaryawanEdit::class)->name('root-karyawan-edit');
        });
        Route::group(['prefix' => 'karyawan-profile'], function () {
            Route::get('/', KaryawanProfile::class)->name('root-karyawan-profile');
            Route::get('/edit/{id}', KaryawanProfileEdit::class)->name('root-karyawan-profile-edit');
        });
    });

    Route::middleware('role:admin|super-admin')->group(function () {
        Route::group(['prefix' => 'unit'], function () {
            Route::get('/', Unit::class)->name('root-unit')->middleware('permission:view_unit');
            Route::get('/edit/{id}', UnitEdit::class)->name('root-unit-edit');
            Route::get('/profil/{id}', UnitProfil::class)->name('root-unit-profil');
        });
        Route::group(['prefix' => 'penjamin'], function () {
            Route::get('/', Penjamin::class)->name('root-penjamin');
            Route::get('/edit/{id}', PenjaminEdit::class)->name('root-penjamin-edit');
        });
        Route::group(['prefix' => 'layanan'], function () {
            Route::get('/', Layanan::class)->name('root-layanan');
            Route::get('/edit/{id}', LayananEdit::class)->name('root-layanan-edit');
        });
        Route::group(['prefix' => 'respon'], function () {
            Route::get('/', Respon::class)->name('root-respon');
            Route::get('/edit/{id}', ResponEdit::class)->name('root-respon-edit');
        });
        Route::group(['prefix' => 'penjamin-layanan'], function () {
            Route::get('/', PenjaminLayanan::class)->name('root-penjamin-layanan');
            Route::get('/edit/{id}', PenjaminLayananEdit::class)->name('root-penjamin-layanan-edit');
        });
        Route::group(['prefix' => 'layanan-respon'], function () {
            Route::get('/', LayananRespon::class)->name('root-layanan-respon');
            Route::get('/edit/{id}', LayananResponEdit::class)->name('root-layanan-respon-edit');
        });
    });
    Route::middleware('role:employee|super-admin')->group(function () {
        Route::get('/petugas/{id}', SurveyPetugas::class)->name('root-survey-petugas');
        Route::get('/laporan', Laporan::class)->name('root-laporan');
        Route::get('/self', UserSetting::class)->name('root-self');
        Route::get('/survey', SurveyPetugasPelayanan::class)->name('isi-survey-pelayanan');
    });

    // Route::get('/unit/profil/edit/{id}', UnitProfil::class)->name('root-unit-profil');

    // Route::get('survey', function(){
    //     return 'halaman isi survey pelayanan';
    // })->name('isi-survey-pelayanan');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/daftar', Register::class)->name('root-guest');
});
