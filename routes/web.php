<?php

use App\Http\Controllers\admin\AmpraGajiController;
use App\Http\Controllers\admin\AsalSuratKeputusanController;
use App\Http\Controllers\admin\BerkasSkppController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JabatanController;
use App\Http\Controllers\admin\JenisAnggotaController;
use App\Http\Controllers\admin\JenisBerkasSkppController;
use App\Http\Controllers\admin\JenisGajiController;
use App\Http\Controllers\admin\JenisSkppController;
use App\Http\Controllers\admin\KartuGajiController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\OperatorController;
use App\Http\Controllers\admin\PangkatController;
use App\Http\Controllers\admin\PegawaiAnggotaController;
use App\Http\Controllers\admin\PegawaiController;
use App\Http\Controllers\admin\PengembalianController;
use App\Http\Controllers\admin\PotonganController;
use App\Http\Controllers\admin\PotonganTunjanganController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\TtdController;
use App\Http\Controllers\admin\TunjanganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\operator\AsalSuratKeputusanController as OperatorAsalSuratKeputusanController;
use App\Http\Controllers\operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\operator\JabatanController as OperatorJabatanController;
use App\Http\Controllers\operator\JenisAnggotaController as OperatorJenisAnggotaController;
use App\Http\Controllers\operator\JenisSkppController as OperatorJenisSkppController;
use App\Http\Controllers\operator\PangkatController as OperatorPangkatController;
use App\Http\Controllers\operator\PegawaiAnggotaController as OperatorPegawaiAnggotaController;
use App\Http\Controllers\operator\PegawaiBerkasController;
use App\Http\Controllers\operator\PegawaiController as OperatorPegawaiController;
use App\Http\Controllers\operator\ProfilController as OperatorProfilController;
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

        // begin:: operator
        Route::prefix('/operator')->group(function () {
            Route::get('/', [OperatorController::class, 'index'])->name('operator');
            Route::get('/det/{any}', [OperatorController::class, 'det'])->name('operator.det');
            Route::get('/get', [OperatorController::class, 'get'])->name('operator.get');
            Route::get('/get_all', [OperatorController::class, 'get_all'])->name('operator.get_all');
            Route::get('/get_data_dt', [OperatorController::class, 'get_data_dt'])->name('operator.get_data_dt');
            Route::post('/save', [OperatorController::class, 'save'])->name('operator.save');
            Route::post('/del', [OperatorController::class, 'del'])->name('operator.del');
        });
        // end:: operator

        // begin:: pangkat
        Route::prefix('/pangkat')->group(function () {
            Route::get('/', [PangkatController::class, 'index'])->name('pangkat');
            Route::get('/get', [PangkatController::class, 'get'])->name('pangkat.get');
            Route::get('/get_all', [PangkatController::class, 'get_all'])->name('pangkat.get_all');
            Route::get('/get_data_dt', [PangkatController::class, 'get_data_dt'])->name('pangkat.get_data_dt');
            Route::post('/save', [PangkatController::class, 'save'])->name('pangkat.save');
            Route::post('/del', [PangkatController::class, 'del'])->name('pangkat.del');
        });
        // end:: pangkat

        // begin:: jabatan
        Route::prefix('/jabatan')->group(function () {
            Route::get('/', [JabatanController::class, 'index'])->name('jabatan');
            Route::get('/get', [JabatanController::class, 'get'])->name('jabatan.get');
            Route::get('/get_all', [JabatanController::class, 'get_all'])->name('jabatan.get_all');
            Route::get('/get_data_dt', [JabatanController::class, 'get_data_dt'])->name('jabatan.get_data_dt');
            Route::post('/save', [JabatanController::class, 'save'])->name('jabatan.save');
            Route::post('/del', [JabatanController::class, 'del'])->name('jabatan.del');
        });
        // end:: jabatan

        // begin:: tunjangan
        Route::prefix('/tunjangan')->group(function () {
            Route::get('/', [TunjanganController::class, 'index'])->name('tunjangan');
            Route::get('/get', [TunjanganController::class, 'get'])->name('tunjangan.get');
            Route::get('/get_all', [TunjanganController::class, 'get_all'])->name('tunjangan.get_all');
            Route::get('/get_data_dt', [TunjanganController::class, 'get_data_dt'])->name('tunjangan.get_data_dt');
            Route::post('/save', [TunjanganController::class, 'save'])->name('tunjangan.save');
            Route::post('/del', [TunjanganController::class, 'del'])->name('tunjangan.del');
        });
        // end:: tunjangan

        // begin:: potongan
        Route::prefix('/potongan')->group(function () {
            Route::get('/', [PotonganController::class, 'index'])->name('potongan');
            Route::get('/get', [PotonganController::class, 'get'])->name('potongan.get');
            Route::get('/get_all', [PotonganController::class, 'get_all'])->name('potongan.get_all');
            Route::get('/get_data_dt', [PotonganController::class, 'get_data_dt'])->name('potongan.get_data_dt');
            Route::post('/save', [PotonganController::class, 'save'])->name('potongan.save');
            Route::post('/del', [PotonganController::class, 'del'])->name('potongan.del');
        });
        // end:: potongan

        // begin:: jenis gaji
        Route::prefix('/jenis_gaji')->group(function () {
            Route::get('/', [JenisGajiController::class, 'index'])->name('jenis_gaji');
            Route::get('/get', [JenisGajiController::class, 'get'])->name('jenis_gaji.get');
            Route::get('/get_all', [JenisGajiController::class, 'get_all'])->name('jenis_gaji.get_all');
            Route::get('/get_data_dt', [JenisGajiController::class, 'get_data_dt'])->name('jenis_gaji.get_data_dt');
            Route::post('/save', [JenisGajiController::class, 'save'])->name('jenis_gaji.save');
            Route::post('/del', [JenisGajiController::class, 'del'])->name('jenis_gaji.del');
        });
        // end:: jenis gaji

        // begin:: jenis anggota keluarga
        Route::prefix('/jenis_anggota')->group(function () {
            Route::get('/', [JenisAnggotaController::class, 'index'])->name('jenis_anggota');
            Route::get('/get', [JenisAnggotaController::class, 'get'])->name('jenis_anggota.get');
            Route::get('/get_all', [JenisAnggotaController::class, 'get_all'])->name('jenis_anggota.get_all');
            Route::get('/get_data_dt', [JenisAnggotaController::class, 'get_data_dt'])->name('jenis_anggota.get_data_dt');
            Route::post('/save', [JenisAnggotaController::class, 'save'])->name('jenis_anggota.save');
            Route::post('/del', [JenisAnggotaController::class, 'del'])->name('jenis_anggota.del');
        });
        // end:: jenis anggota keluarga

        // begin:: ttd
        Route::prefix('/ttd')->group(function () {
            Route::get('/', [TtdController::class, 'index'])->name('ttd');
            Route::get('/get', [TtdController::class, 'get'])->name('ttd.get');
            Route::get('/get_all', [TtdController::class, 'get_all'])->name('ttd.get_all');
            Route::get('/get_data_dt', [TtdController::class, 'get_data_dt'])->name('ttd.get_data_dt');
            Route::post('/save', [TtdController::class, 'save'])->name('ttd.save');
            Route::post('/del', [TtdController::class, 'del'])->name('ttd.del');
        });
        // end:: ttd

        // begin:: asal surat keputusan
        Route::prefix('/asal_surat_keputusan')->group(function () {
            Route::get('/', [AsalSuratKeputusanController::class, 'index'])->name('asal_surat_keputusan');
            Route::get('/get', [AsalSuratKeputusanController::class, 'get'])->name('asal_surat_keputusan.get');
            Route::get('/get_all', [AsalSuratKeputusanController::class, 'get_all'])->name('asal_surat_keputusan.get_all');
            Route::get('/get_data_dt', [AsalSuratKeputusanController::class, 'get_data_dt'])->name('asal_surat_keputusan.get_data_dt');
            Route::post('/save', [AsalSuratKeputusanController::class, 'save'])->name('asal_surat_keputusan.save');
            Route::post('/del', [AsalSuratKeputusanController::class, 'del'])->name('asal_surat_keputusan.del');
        });
        // end:: asal surat keputusan

        // begin:: pegawai
        Route::prefix('/pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
            Route::get('/det/{any}', [PegawaiController::class, 'det'])->name('pegawai.det');
            Route::get('/get_all', [PegawaiController::class, 'get_all'])->name('pegawai.get_all');
            Route::get('/get_data_dt', [PegawaiController::class, 'get_data_dt'])->name('pegawai.get_data_dt');

            // begin:: pegawai anggota
            Route::prefix('/anggota')->group(function () {
                Route::get('/get_all', [PegawaiAnggotaController::class, 'get_all'])->name('pegawai.anggota.get_all');
                Route::get('/get_data_dt', [PegawaiAnggotaController::class, 'get_data_dt'])->name('pegawai.anggota.get_data_dt');
            });
            // end:: pegawai anggota
        });
        // end:: pegawai

        // begin:: jenis skpp
        Route::prefix('/jenis_skpp')->group(function () {
            Route::get('/', [JenisSkppController::class, 'index'])->name('jenis_skpp');
            Route::get('/get', [JenisSkppController::class, 'get'])->name('jenis_skpp.get');
            Route::get('/get_all', [JenisSkppController::class, 'get_all'])->name('jenis_skpp.get_all');
            Route::get('/get_data_dt', [JenisSkppController::class, 'get_data_dt'])->name('jenis_skpp.get_data_dt');
            Route::post('/save', [JenisSkppController::class, 'save'])->name('jenis_skpp.save');
            Route::post('/del', [JenisSkppController::class, 'del'])->name('jenis_skpp.del');
        });
        // end:: jenis skpp

        // begin:: berkas skpp
        Route::prefix('/berkas_skpp')->group(function () {
            Route::get('/', [BerkasSkppController::class, 'index'])->name('berkas_skpp');
            Route::get('/get', [BerkasSkppController::class, 'get'])->name('berkas_skpp.get');
            Route::get('/get_all', [BerkasSkppController::class, 'get_all'])->name('berkas_skpp.get_all');
            Route::get('/get_data_dt', [BerkasSkppController::class, 'get_data_dt'])->name('berkas_skpp.get_data_dt');
            Route::post('/save', [BerkasSkppController::class, 'save'])->name('berkas_skpp.save');
            Route::post('/del', [BerkasSkppController::class, 'del'])->name('berkas_skpp.del');
        });
        // end:: berkas skpp

        // begin:: jenis berkas skpp
        Route::prefix('/jenis_berkas_skpp')->group(function () {
            Route::get('/', [JenisBerkasSkppController::class, 'index'])->name('jenis_berkas_skpp');
            Route::get('/get', [JenisBerkasSkppController::class, 'get'])->name('jenis_berkas_skpp.get');
            Route::get('/get_data_dt', [JenisBerkasSkppController::class, 'get_data_dt'])->name('jenis_berkas_skpp.get_data_dt');
            Route::post('/save', [JenisBerkasSkppController::class, 'save'])->name('jenis_berkas_skpp.save');
            Route::post('/del', [JenisBerkasSkppController::class, 'del'])->name('jenis_berkas_skpp.del');
        });
        // end:: jenis berkas skpp

        // begin:: potongan tunjangan
        Route::prefix('/potongan_tunjangan')->group(function () {
            Route::get('/', [PotonganTunjanganController::class, 'index'])->name('potongan_tunjangan');
            Route::get('/get', [PotonganTunjanganController::class, 'get'])->name('potongan_tunjangan.get');
            Route::get('/get_data_dt', [PotonganTunjanganController::class, 'get_data_dt'])->name('potongan_tunjangan.get_data_dt');
            Route::post('/save', [PotonganTunjanganController::class, 'save'])->name('potongan_tunjangan.save');
            Route::post('/del', [PotonganTunjanganController::class, 'del'])->name('potongan_tunjangan.del');
        });
        // end:: potongan tunjangan

        // begin:: ampra gaji
        Route::prefix('/ampra_gaji')->group(function () {
            Route::get('/', [AmpraGajiController::class, 'index'])->name('ampra_gaji');
            Route::get('/add', [AmpraGajiController::class, 'add'])->name('ampra_gaji.add');
            Route::get('/upd/{any}', [AmpraGajiController::class, 'upd'])->name('ampra_gaji.upd');
            Route::get('/det/{any}', [AmpraGajiController::class, 'det'])->name('ampra_gaji.det');
            Route::get('/tunjangan/{any}', [AmpraGajiController::class, 'tunjangan'])->name('ampra_gaji.tunjangan');
            Route::get('/potongan/{any}', [AmpraGajiController::class, 'potongan'])->name('ampra_gaji.potongan');
            Route::get('/get', [AmpraGajiController::class, 'get'])->name('ampra_gaji.get');
            Route::get('/get_data_dt', [AmpraGajiController::class, 'get_data_dt'])->name('ampra_gaji.get_data_dt');
            Route::post('/save', [AmpraGajiController::class, 'save'])->name('ampra_gaji.save');
            Route::post('/del', [AmpraGajiController::class, 'del'])->name('ampra_gaji.del');

            // begin:: kartu gaji
            Route::prefix('/kartu_gaji')->group(function () {
                Route::get('/{any}', [KartuGajiController::class, 'index'])->name('kartu_gaji')->where('id', '[0-9]+');
                Route::get('/det/{id}/{any}', [KartuGajiController::class, 'det'])->name('kartu_gaji.det');
                Route::get('/print/{any}', [KartuGajiController::class, 'print'])->name('kartu_gaji.print');
                Route::get('/tunjangan/{any}', [KartuGajiController::class, 'tunjangan'])->name('kartu_gaji.tunjangan');
                Route::get('/potongan/{any}', [KartuGajiController::class, 'potongan'])->name('kartu_gaji.potongan');
                Route::get('/get_data_dt/{any}', [KartuGajiController::class, 'get_data_dt'])->name('kartu_gaji.get_data_dt');
                Route::post('/save', [KartuGajiController::class, 'save'])->name('kartu_gaji.save');
                Route::post('/del', [KartuGajiController::class, 'del'])->name('kartu_gaji.del');
            });
            // end:: kartu gaji

            // begin:: pengembalian
            Route::prefix('/pengembalian')->group(function () {
                Route::get('/{any}', [PengembalianController::class, 'index'])->name('pengembalian')->where('id', '[0-9]+');
                Route::get('/get_data_dt/{any}', [PengembalianController::class, 'get_data_dt'])->name('pengembalian.get_data_dt');
                Route::post('/save', [PengembalianController::class, 'save'])->name('pengembalian.save');
                Route::post('/del', [PengembalianController::class, 'del'])->name('pengembalian.del');
            });
            // end:: pengembalian
        });
        // end:: ampra gaji

        // begin:: laporan
        Route::prefix('/laporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('laporan');
            Route::get('/skpp', [LaporanController::class, 'skpp'])->name('laporan.skpp');
            Route::get('/get_data_skpp_dt', [LaporanController::class, 'get_data_skpp_dt'])->name('laporan.get_data_skpp_dt');
        });
        // end:: laporan
    });
    // end:: admin

    // begin:: operator
    Route::group(['prefix' => 'operator', 'as' => 'operator.'], function () {
        Route::get('/', [OperatorDashboardController::class, 'index'])->name('dashboard');

        // begin:: profil
        Route::prefix('/profil')->group(function () {
            Route::get('/', [OperatorProfilController::class, 'index'])->name('profil');
            Route::post('/save_picture', [OperatorProfilController::class, 'save_picture'])->name('profil.save_picture');
            Route::post('/save_account', [OperatorProfilController::class, 'save_account'])->name('profil.save_account');
            Route::post('/save_security', [OperatorProfilController::class, 'save_security'])->name('profil.save_security');
        });
        // end:: profil

        // begin:: jenis skpp
        Route::prefix('/jenis_skpp')->group(function () {
            Route::get('/get_all', [OperatorJenisSkppController::class, 'get_all'])->name('jenis_skpp.get_all');
        });
        // end:: jenis skpp

        // begin:: pangkat
        Route::prefix('/pangkat')->group(function () {
            Route::get('/get_all', [OperatorPangkatController::class, 'get_all'])->name('pangkat.get_all');
        });
        // end:: pangkat

        // begin:: jabatan
        Route::prefix('/jabatan')->group(function () {
            Route::get('/get_all', [OperatorJabatanController::class, 'get_all'])->name('jabatan.get_all');
        });
        // end:: jabatan

        // begin:: asal surat keputusan
        Route::prefix('/asal_surat_keputusan')->group(function () {
            Route::get('/get_all', [OperatorAsalSuratKeputusanController::class, 'get_all'])->name('asal_surat_keputusan.get_all');
        });
        // end:: asal surat keputusan

        // begin:: jenis anggota keluarga
        Route::prefix('/jenis_anggota')->group(function () {
            Route::get('/get_all', [OperatorJenisAnggotaController::class, 'get_all'])->name('jenis_anggota.get_all');
        });
        // end:: jenis anggota keluarga

        // begin:: pegawai
        Route::prefix('/pegawai')->group(function () {
            Route::get('/', [OperatorPegawaiController::class, 'index'])->name('pegawai');
            Route::get('/add', [OperatorPegawaiController::class, 'add'])->name('pegawai.add');
            Route::get('/upd/{any}', [OperatorPegawaiController::class, 'upd'])->name('pegawai.upd');
            Route::get('/get_all', [OperatorPegawaiController::class, 'get_all'])->name('pegawai.get_all');
            Route::get('/get_data_dt', [OperatorPegawaiController::class, 'get_data_dt'])->name('pegawai.get_data_dt');
            Route::post('/save', [OperatorPegawaiController::class, 'save'])->name('pegawai.save');
            Route::post('/del', [OperatorPegawaiController::class, 'del'])->name('pegawai.del');

            // begin:: pegawai anggota
            Route::prefix('/anggota')->group(function () {
                Route::get('/get', [OperatorPegawaiAnggotaController::class, 'get'])->name('pegawai.anggota.get');
                Route::get('/get_data_dt', [OperatorPegawaiAnggotaController::class, 'get_data_dt'])->name('pegawai.anggota.get_data_dt');
                Route::post('/save', [OperatorPegawaiAnggotaController::class, 'save'])->name('pegawai.anggota.save');
                Route::post('/del', [OperatorPegawaiAnggotaController::class, 'del'])->name('pegawai.anggota.del');
            });
            // end:: pegawai anggota

            // begin:: pegawai berkas
            Route::prefix('/berkas')->group(function () {
                Route::get('/add/{any}', [PegawaiBerkasController::class, 'add'])->name('pegawai.berkas.add');
                Route::post('/check', [PegawaiBerkasController::class, 'check'])->name('pegawai.berkas.check');
                Route::post('/save', [PegawaiBerkasController::class, 'save'])->name('pegawai.berkas.save');
            });
            // end:: pegawai berkas
        });
        // end:: pegawai
    });
    // end:: operator
});
