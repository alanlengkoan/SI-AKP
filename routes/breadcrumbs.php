<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// begin:: admin
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Profil', route('admin.profil'));
});

Breadcrumbs::for('admin.users.users', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Users', route('admin.users.users'));
});

Breadcrumbs::for('admin.agama.agama', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Agama', route('admin.agama.agama'));
});

Breadcrumbs::for('admin.jabatan.jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Jabatan', route('admin.jabatan.jabatan'));
});

Breadcrumbs::for('admin.pangkat.pangkat', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pangkat', route('admin.pangkat.pangkat'));
});

Breadcrumbs::for('admin.pendidikan.pendidikan', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pendidikan', route('admin.pendidikan.pendidikan'));
});

Breadcrumbs::for('admin.gapok.gapok', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pendidikan', route('admin.gapok.gapok'));
});

Breadcrumbs::for('admin.pegawai.pegawai', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pegawai', route('admin.pegawai.pegawai'));
});

Breadcrumbs::for('admin.pegawai.det', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pegawai.pegawai');

    $trail->push('Detail', '#');
});

Breadcrumbs::for('admin.pegawai.pangkat.pangkat', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pegawai.pegawai');

    $trail->push('Pangkat', route('admin.pegawai.pangkat.pangkat'));
});

Breadcrumbs::for('admin.laporan.pegawai', function ($trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pegawai', route('admin.laporan.pegawai'));
});

Breadcrumbs::for('admin.laporan.pensiun', function ($trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pensiun', route('admin.laporan.pensiun'));
});

Breadcrumbs::for('admin.laporan.pangkat', function ($trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Pangkat', route('admin.laporan.pangkat'));
});
// end:: admin

// begin:: camat
Breadcrumbs::for('camat.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('camat.dashboard'));
});

Breadcrumbs::for('camat.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('camat.dashboard');

    $trail->push('Profil', route('camat.profil'));
});

Breadcrumbs::for('camat.pegawai.pegawai', function (BreadcrumbTrail $trail) {
    $trail->parent('camat.dashboard');

    $trail->push('Pegawai', '#');
});

Breadcrumbs::for('camat.pegawai.det', function (BreadcrumbTrail $trail) {
    $trail->parent('camat.pegawai.pegawai');

    $trail->push('Detail', '#');
});


Breadcrumbs::for('camat.laporan.pegawai', function ($trail) {
    $trail->parent('camat.dashboard');

    $trail->push('Pegawai', route('camat.laporan.pegawai'));
});

Breadcrumbs::for('camat.laporan.pensiun', function ($trail) {
    $trail->parent('camat.dashboard');

    $trail->push('Pensiun', route('camat.laporan.pensiun'));
});

Breadcrumbs::for('camat.laporan.pangkat', function ($trail) {
    $trail->parent('camat.dashboard');

    $trail->push('Pangkat', route('camat.laporan.pangkat'));
});
// end:: camat

// begin:: pegawai
Breadcrumbs::for('pegawai.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('pegawai.dashboard'));
});

Breadcrumbs::for('pegawai.profil', function (BreadcrumbTrail $trail) {
    $trail->parent('pegawai.dashboard');

    $trail->push('Profil', route('pegawai.profil'));
});

Breadcrumbs::for('pegawai.pegawai.pegawai', function (BreadcrumbTrail $trail) {
    $trail->parent('pegawai.dashboard');

    $trail->push('Pegawai', '#');
});

Breadcrumbs::for('pegawai.pegawai.det', function (BreadcrumbTrail $trail) {
    $trail->parent('pegawai.pegawai.pegawai');

    $trail->push('Detail', '#');
});

Breadcrumbs::for('pegawai.laporan.pegawai', function ($trail) {
    $trail->parent('pegawai.dashboard');

    $trail->push('Pegawai', route('pegawai.laporan.pegawai'));
});

Breadcrumbs::for('pegawai.laporan.pensiun', function ($trail) {
    $trail->parent('pegawai.dashboard');

    $trail->push('Pensiun', route('pegawai.laporan.pensiun'));
});

Breadcrumbs::for('pegawai.laporan.pangkat', function ($trail) {
    $trail->parent('pegawai.dashboard');

    $trail->push('Pangkat', route('pegawai.laporan.pangkat'));
});
// end:: pegawai