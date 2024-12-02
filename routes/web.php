<?php

use App\Livewire\Admin\Karyawan\{Karyawan, KaryawanEdit};
use App\Livewire\Admin\KaryawanProfile\{KaryawanProfile, KaryawanProfileEdit};
use App\Livewire\Admin\Layanan\{Layanan, LayananEdit};
use App\Livewire\Admin\LayananRespon\{LayananRespon, LayananResponEdit};
use App\Livewire\Admin\Penjamin\{Penjamin, PenjaminEdit};
use App\Livewire\Admin\PenjaminLayanan\{PenjaminLayanan, PenjaminLayananEdit};
use App\Livewire\Admin\Respon\{Respon, ResponEdit};
use App\Livewire\Admin\Unit\UnitMultiLayanan\MultiLayanan;
use App\Livewire\Admin\Unit\UnitProfil\UnitProfil;
use App\Livewire\Admin\Unit\{Unit, UnitEdit};
use App\Livewire\Admin\{RootsAdmin, SurveyPetugas};
use App\Livewire\Auth\Login;
use App\Livewire\Guest\Register;
use App\Livewire\Sdm\Laporan;
use App\Livewire\Self\UserSetting;
use App\Livewire\SuperAdmin\RolePermission\{Permission, PermissionEdit, Role, RoleEdit, RoleManage};
use App\Livewire\SuperAdmin\Setting\AppSetting;
use App\Livewire\SuperAdmin\User\User;
use App\Livewire\SuperAdmin\User\UserManage;
use App\Livewire\{Home, HomeSurvey, HomeSurveyMulti, LockerStudio};
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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
    //     // Route::get('/', Roots::class)->name('roots-dashboard');
    // Route::get('/', Home::class)->name('roots-dashboard');
    Route::get('/logout', [Login::class, 'logout'])->name('logout');
    Volt::route('/home-single', 'home.single-layanan')->name('home-single');
    Volt::route('/home-multi', 'home.multi-layanan')->name('home-multi');
    Volt::route('/home', 'home.idle')->name('home-idle');
    Volt::route('/', 'home.idle');
    Volt::route('/survey-pasien', 'survey.pasien')->name('survey-pasien');
    //     Route::get('/lihat', RootsAdmin::class)->name('lihat');

    //     Route::middleware('role:super-admin')->group(function () {
    //         Route::group(['prefix' => 'setting'], function () {
    //             Route::get('/', AppSetting::class)->name('root-setting-app');
    //         });
    //         Route::group(['prefix' => 'user'], function () {
    //             Route::get('/', User::class)->name('root-super-admin-user');
    //             Route::get('/manage/{id}', UserManage::class)->name('root-super-admin-user-manage');
    //         });
    //         Route::group(['prefix' => 'permission'], function () {
    //             Route::get('/', Permission::class)->name('root-super-admin-permission');
    //             Route::get('/edit/{id}', PermissionEdit::class)->name('root-super-admin-permission-edit');
    //         });
    //         Route::group(['prefix' => 'role'], function () {
    //             Route::get('/', Role::class)->name('root-super-admin-role');
    //             Route::get('/edit/{id}', RoleEdit::class)->name('root-super-admin-role-edit');
    //             Route::get('/manage/{id}', RoleManage::class)->name('root-super-admin-role-manage');
    //         });
    //     });

    //     Route::middleware('role:hr|super-admin')->group(function () {
    //         Route::group(['prefix' => 'karyawan'], function () {
    //             Route::get('/', Karyawan::class)->name('root-karyawan');
    //             Route::get('/edit/{id}', KaryawanEdit::class)->name('root-karyawan-edit');
    //         });
    //         Route::group(['prefix' => 'karyawan-profile'], function () {
    //             Route::get('/', KaryawanProfile::class)->name('root-karyawan-profile');
    //             Route::get('/edit/{id}', KaryawanProfileEdit::class)->name('root-karyawan-profile-edit');
    //         });
    //         Route::group(['prefix' => 'unit'], function () {
    //             Route::get('/', Unit::class)->name('root-unit');
    //             Route::get('/edit/{id}', UnitEdit::class)->name('root-unit-edit');
    //             Route::get('/profil/{id}', UnitProfil::class)->name('root-unit-profil');
    //             Route::group(['prefix' => 'multi-layanan'], function () {
    //                 Route::get('/{id}', MultiLayanan::class)->name('root-multi-layanan');
    //             });
    //         });
    //     });

    //     Route::middleware('role:admin|super-admin')->group(function () {
    //         Route::group(['prefix' => 'penjamin'], function () {
    //             Route::get('/', Penjamin::class)->name('root-penjamin');
    //             Route::get('/edit/{id}', PenjaminEdit::class)->name('root-penjamin-edit');
    //         });
    //         Route::group(['prefix' => 'layanan'], function () {
    //             Route::get('/', Layanan::class)->name('root-layanan');
    //             Route::get('/edit/{id}', LayananEdit::class)->name('root-layanan-edit');
    //         });
    //         Route::group(['prefix' => 'respon'], function () {
    //             Route::get('/', Respon::class)->name('root-respon');
    //             Route::get('/edit/{id}', ResponEdit::class)->name('root-respon-edit');
    //         });
    //         Route::group(['prefix' => 'penjamin-layanan'], function () {
    //             Route::get('/', PenjaminLayanan::class)->name('root-penjamin-layanan');
    //             Route::get('/edit/{id}', PenjaminLayananEdit::class)->name('root-penjamin-layanan-edit');
    //         });
    //         Route::group(['prefix' => 'layanan-respon'], function () {
    //             Route::get('/', LayananRespon::class)->name('root-layanan-respon');
    //             Route::get('/edit/{id}', LayananResponEdit::class)->name('root-layanan-respon-edit');
    //         });
    //     });

    Route::middleware('role:employee|super-admin|monitor')->group(function () {
        Volt::route('/survey-masuk', 'employee.survey-masuk')->name('survey-masuk');
        // Volt::route('/profile-petugas', 'employee.profile-petugas')->name('profile-petugas');

        //         Route::get('/petugas', SurveyPetugas::class)->name('root-survey-petugas');
        //         Route::get('/locker-studio', LockerStudio::class)->name('root-survey-locker-studio');
        //         Route::get('/laporan', Laporan::class)->name('root-laporan');
        //         Route::get('/self', UserSetting::class)->name('root-self');
        //         // Route::get('/survey', SurveyPetugasPelayanan::class)->name('isi-survey-pelayanan');
        //         Route::get('/survey', HomeSurvey::class)->name('isi-survey-pelayanan');
        //         Route::get('/multi-survey', HomeSurveyMulti::class)->name('isi-survey-pelayanan-multi');
    });
});

Route::middleware(['guest'])->group(function () {
    Volt::route('/login', 'login')->name('login');
    Route::get('/daftar', Register::class)->name('root-guest');
});
