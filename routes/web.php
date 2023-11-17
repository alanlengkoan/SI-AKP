<?php

use App\Http\Controllers\admin\AgamaController;
use App\Http\Controllers\admin\CutiController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GapokController;
use App\Http\Controllers\admin\JabatanController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\PangkatController;
use App\Http\Controllers\admin\PegawaiController;
use App\Http\Controllers\admin\PegawaiPangkatController;
use App\Http\Controllers\admin\PendidikanController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\camat\DashboardController as CamatDashboardController;
use App\Http\Controllers\camat\LaporanController as CamatLaporanController;
use App\Http\Controllers\camat\PegawaiController as CamatPegawaiController;
use App\Http\Controllers\camat\ProfilController as CamatProfilController;
use App\Http\Controllers\pegawai\DashboardController as PegawaiDashboardController;
use App\Http\Controllers\pegawai\LaporanController as PegawaiLaporanController;
use App\Http\Controllers\pegawai\PegawaiController as PegawaiPegawaiController;
use App\Http\Controllers\pegawai\ProfilController as PegawaiProfilController;
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

        // begin:: users
        Route::controller(UsersController::class)->prefix('users')->as('users.')->group(function () {
            Route::get('/', 'index')->name('users');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/save', 'save')->name('save');
            Route::post('/active', 'active')->name('active');
            Route::post('/reset_password', 'reset_password')->name('reset_password');
        });
        // end:: users

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

        // begin:: cuti
        Route::controller(CutiController::class)->prefix('cuti')->as('cuti.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/get_data_dt', 'get_data_dt')->name('get_data_dt');
            Route::post('/show', 'show')->name('show');
            Route::post('/save', 'save')->name('save');
            Route::post('/del', 'del')->name('del');
        });
        // end:: cuti

        // begin:: pegawai
        Route::controller(PegawaiController::class)->prefix('pegawai')->as('pegawai.')->group(function () {
            Route::get('/', 'index')->name('pegawai');
            Route::get('/det/{id}', 'det')->name('det');
            Route::get('/print/{id}', 'print')->name('print');
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

        // begin:: laporan
        Route::controller(LaporanController::class)->prefix('laporan')->as('laporan.')->group(function () {
            Route::get('/pegawai', 'pegawai')->name('pegawai');
            Route::post('/pegawai/get_data_dt', 'pegawai_get_data_dt')->name('pegawai.get_data_dt');

            Route::get('/pensiun', 'pensiun')->name('pensiun');
            Route::post('/pensiun/get_data_dt', 'pensiun_get_data_dt')->name('pensiun.get_data_dt');

            Route::get('/pangkat', 'pangkat')->name('pangkat');
            Route::post('/pangkat/get_data_dt', 'pangkat_get_data_dt')->name('pangkat.get_data_dt');
        });
        // end:: laporan
    });
    // end:: admin

    // begin:: camat
    Route::group(['prefix' => 'camat', 'as' => 'camat.'], function () {
        Route::get('/', [CamatDashboardController::class, 'index'])->name('dashboard');

        // begin:: profil
        Route::prefix('/profil')->group(function () {
            Route::get('/', [CamatProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [CamatProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [CamatProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [CamatProfilController::class, 'save_security'])->name('profil.save_security');
        });
        // end:: profil

        // begin:: pegawai
        Route::controller(CamatPegawaiController::class)->prefix('pegawai')->as('pegawai.')->group(function () {
            Route::get('/det/{id}', 'det')->name('det');
            Route::get('/print/{id}', 'print')->name('print');
        });
        // end:: pegawai

        // begin:: laporan
        Route::controller(CamatLaporanController::class)->prefix('laporan')->as('laporan.')->group(function () {
            Route::get('/pegawai', 'pegawai')->name('pegawai');
            Route::post('/pegawai/get_data_dt', 'pegawai_get_data_dt')->name('pegawai.get_data_dt');

            Route::get('/pensiun', 'pensiun')->name('pensiun');
            Route::post('/pensiun/get_data_dt', 'pensiun_get_data_dt')->name('pensiun.get_data_dt');

            Route::get('/pangkat', 'pangkat')->name('pangkat');
            Route::post('/pangkat/get_data_dt', 'pangkat_get_data_dt')->name('pangkat.get_data_dt');
        });
        // end:: laporan
    });
    // end:: camat

    // begin:: pegawai
    Route::group(['prefix' => 'pegawai', 'as' => 'pegawai.'], function () {
        Route::get('/', [PegawaiDashboardController::class, 'index'])->name('dashboard');

        // begin:: profil
        Route::prefix('/profil')->group(function () {
            Route::get('/', [PegawaiProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [PegawaiProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [PegawaiProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [PegawaiProfilController::class, 'save_security'])->name('profil.save_security');
        });
        // end:: profil

        // begin:: pegawai
        Route::controller(PegawaiPegawaiController::class)->prefix('pegawai')->as('pegawai.')->group(function () {
            Route::get('/det/{id}', 'det')->name('det');
            Route::get('/print/{id}', 'print')->name('print');
        });
        // end:: pegawai

        // begin:: laporan
        Route::controller(PegawaiLaporanController::class)->prefix('laporan')->as('laporan.')->group(function () {
            Route::get('/pegawai', 'pegawai')->name('pegawai');
            Route::post('/pegawai/get_data_dt', 'pegawai_get_data_dt')->name('pegawai.get_data_dt');

            Route::get('/pensiun', 'pensiun')->name('pensiun');
            Route::post('/pensiun/get_data_dt', 'pensiun_get_data_dt')->name('pensiun.get_data_dt');

            Route::get('/pangkat', 'pangkat')->name('pangkat');
            Route::post('/pangkat/get_data_dt', 'pangkat_get_data_dt')->name('pangkat.get_data_dt');
        });
        // end:: laporan
    });
    // end:: pegawai
});
