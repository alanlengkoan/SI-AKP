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

Breadcrumbs::for('admin.agama.agama', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');

    $trail->push('Agama', route('admin.agama.agama'));
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
