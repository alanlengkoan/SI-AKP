<?php

use App\Models\AmpraGaji;
use App\Models\KartuGaji;
use App\Models\Operator;
use App\Models\Pegawai;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Profil', route('admin.profil'));
});

Breadcrumbs::for('admin.operator', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Operator', route('admin.operator'));
});

Breadcrumbs::for('admin.operator.det', function (BreadcrumbTrail $trail, Operator $post) {
    $trail->parent('admin.operator');

    $trail->push('Detail', route('admin.operator.det', $post->id_operator));
});

Breadcrumbs::for('admin.pangkat', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pangkat', route('admin.pangkat'));
});

Breadcrumbs::for('admin.jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Jabatan', route('admin.jabatan'));
});

Breadcrumbs::for('admin.tunjangan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Tunjangan', route('admin.tunjangan'));
});

Breadcrumbs::for('admin.potongan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Potongan', route('admin.potongan'));
});

Breadcrumbs::for('admin.jenis_anggota', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Jenis Anggota Keluarga', route('admin.jenis_anggota'));
});

Breadcrumbs::for('admin.jenis_gaji', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Jenis Gaji', route('admin.jenis_gaji'));
});

Breadcrumbs::for('admin.jenis_skpp', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Jenis SKPP', route('admin.jenis_skpp'));
});

Breadcrumbs::for('admin.berkas_skpp', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Berkas SKPP', route('admin.berkas_skpp'));
});

Breadcrumbs::for('admin.asal_surat_keputusan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Asal Surat Keputusan', route('admin.asal_surat_keputusan'));
});

Breadcrumbs::for('admin.ttd', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Tanda Tangan', route('admin.ttd'));
});

Breadcrumbs::for('admin.pegawai', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pegawai', route('admin.pegawai'));
});

Breadcrumbs::for('admin.pegawai.det', function (BreadcrumbTrail $trail, Pegawai $post) {
    $trail->parent('admin.pegawai');

    $trail->push('Detail Pegawai', route('admin.pegawai.det', $post->id_pegawai));
});

Breadcrumbs::for('admin.potongan_tunjangan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Potongan Tunjangan', route('admin.potongan_tunjangan'));
});

Breadcrumbs::for('admin.ampra_gaji', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Buat SKPP', route('admin.ampra_gaji'));
});

Breadcrumbs::for('admin.ampra_gaji.add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Tambah SKPP');
});

Breadcrumbs::for('admin.ampra_gaji.upd', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Ubah SKPP');
});

Breadcrumbs::for('admin.ampra_gaji.det', function (BreadcrumbTrail $trail, AmpraGaji $post) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Detail SKPP', route('admin.ampra_gaji.det', $post->id_ampra_gaji));
});

Breadcrumbs::for('admin.ampra_gaji.tunjangan', function (BreadcrumbTrail $trail, AmpraGaji $post) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Tunjangan', route('admin.ampra_gaji.tunjangan', $post->id_ampra_gaji));
});

Breadcrumbs::for('admin.ampra_gaji.potongan', function (BreadcrumbTrail $trail, AmpraGaji $post) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Potongan', route('admin.ampra_gaji.potongan', $post->id_ampra_gaji));
});

Breadcrumbs::for('admin.kartu_gaji', function (BreadcrumbTrail $trail, AmpraGaji $post) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Kartu Gaji', route('admin.kartu_gaji', $post->id_ampra_gaji));
});

Breadcrumbs::for('admin.kartu_gaji.det', function (BreadcrumbTrail $trail, AmpraGaji $ampra_gaji, KartuGaji $kartu_gaji) {
    $trail->parent('admin.kartu_gaji', $ampra_gaji);

    $trail->push('Detail', route('admin.kartu_gaji.det', ['id' => $ampra_gaji->id_ampra_gaji, 'any' => $kartu_gaji->id_kartu_gaji]));
});

Breadcrumbs::for('admin.pengembalian', function (BreadcrumbTrail $trail, AmpraGaji $post) {
    $trail->parent('admin.ampra_gaji');

    $trail->push('Pengembalian', route('admin.pengembalian', $post->id_ampra_gaji));
});

Breadcrumbs::for('admin.laporan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Laporan');
});

Breadcrumbs::for('admin.laporan.skpp', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.laporan');

    $trail->push('SKPP');
});

// operator

Breadcrumbs::for('operator.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('operator.dashboard'));
});

Breadcrumbs::for('operator.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('operator.dashboard');

    $trail->push('Profil', route('operator.profil'));
});

Breadcrumbs::for('operator.pegawai', function (BreadcrumbTrail $trail) {
    $trail->parent('operator.dashboard');

    $trail->push('Pegawai', route('operator.pegawai'));
});

Breadcrumbs::for('operator.pegawai.add', function (BreadcrumbTrail $trail) {
    $trail->parent('operator.pegawai');

    $trail->push('Tambah Pegawai', route('operator.pegawai.add'));
});

Breadcrumbs::for('operator.pegawai.upd', function (BreadcrumbTrail $trail, Pegawai $post) {
    $trail->parent('operator.pegawai');

    $trail->push('Ubah Pegawai', route('operator.pegawai.upd', $post->id_pegawai));
});

Breadcrumbs::for('operator.pegawai.berkas.add', function (BreadcrumbTrail $trail, Pegawai $post) {
    $trail->parent('operator.pegawai');

    $trail->push('Berkas Pegawai', route('operator.pegawai.berkas.add', $post->id_pegawai));
});
