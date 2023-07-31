<?php

use App\Http\Controllers\admin\AgamaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GapokController;
use App\Http\Controllers\admin\JabatanController;
use App\Http\Controllers\admin\PangkatController;
use App\Http\Controllers\admin\PegawaiController;
use App\Http\Controllers\admin\PegawaiPangkatController;
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

        // begin:: jabatan
        Route::controller(JabatanController::class)->prefix('jabatan')->as('jabatan.')->group(function () {
            Route::get('/', 'index')->name('jabatan');
            Route::get('/get_all', 'get_all')->name('get_all');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: jabatan

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
            Route::get('/det/{id}', 'det')->name('det');
            Route::get('get_all', 'get_all')->name('get_all');
            Route::post('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');

            // begin:: pegawai pangkat
            Route::controller(PegawaiPangkatController::class)->prefix('/pangkat')->as('pangkat.')->group(function () {
                Route::get('/', 'index')->name('pangkat');
                Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
                Route::post('/show', 'show')->name('show');
                Route::post('/save', 'save')->name('save');
                Route::post('/del', 'del')->name('del');
            });
            // end:: pegawai pangkat
        });
        // end:: pegawai
    });
    // end:: admin
});
