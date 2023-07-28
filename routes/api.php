<?php

use App\Http\Controllers\api\Kecelakaan;
use App\Http\Controllers\api\KecelakaanKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// kecelakaan kateogri
Route::get('/kecelakaan_kategori', [KecelakaanKategori::class, 'index']);
// kecelakaan
Route::get('/kecelakaan/chart', [Kecelakaan::class, 'chart']);
Route::post('/kecelakaan/add', [Kecelakaan::class, 'add']);