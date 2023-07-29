<?php

use App\Http\Controllers\admin\AgamaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GapokController;
use App\Http\Controllers\admin\PangkatController;
use App\Http\Controllers\admin\PegawaiController;
use App\Http\Controllers\admin\PendidikanController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// begin:: auth
Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
// end:: auth

Route::group(['middleware' => ['session.auth', 'prevent.back.history']], function () {
    // begin:: admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // begin:: profil
        Route::prefix('/profil')->group(function () {
            Route::get('/', [ProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [ProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [ProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [ProfilController::class, 'save_security'])->name('profil.save_security');
        });
        // end:: profil

        // begin:: agama
        Route::controller(AgamaController::class)->prefix('agama')->as('agama.')->group(function () {
            Route::get('/', 'index')->name('agama');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: agama

        // begin:: pangkat
        Route::controller(PangkatController::class)->prefix('pangkat')->as('pangkat.')->group(function () {
            Route::get('/', 'index')->name('pangkat');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: pangkat

        // begin:: pendidikan
        Route::controller(PendidikanController::class)->prefix('pendidikan')->as('pendidikan.')->group(function () {
            Route::get('/', 'index')->name('pendidikan');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: pendidikan

        // begin:: gapok
        Route::controller(GapokController::class)->prefix('gapok')->as('gapok.')->group(function () {
            Route::get('/', 'index')->name('gapok');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: gapok

        // begin:: pegawai
        Route::controller(PegawaiController::class)->prefix('pegawai')->as('pegawai.')->group(function () {
            Route::get('/', 'index')->name('pegawai');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });

        // Route::prefix('/pegawai')->group(function () {
        //     Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
        //     Route::get('/det/{any}', [PegawaiController::class, 'det'])->name('pegawai.det');
        //     Route::get('/get_all', [PegawaiController::class, 'get_all'])->name('pegawai.get_all');
        //     Route::get('/get_data_dt', [PegawaiController::class, 'get_data_dt'])->name('pegawai.get_data_dt');

        //     // begin:: pegawai anggota
        //     Route::prefix('/anggota')->group(function () {
        //         Route::get('/get_all', [PegawaiAnggotaController::class, 'get_all'])->name('pegawai.anggota.get_all');
        //         Route::get('/get_data_dt', [PegawaiAnggotaController::class, 'get_data_dt'])->name('pegawai.anggota.get_data_dt');
        //     });
        //     // end:: pegawai anggota
        // });
        // end:: pegawai
    });
    // end:: admin
});
