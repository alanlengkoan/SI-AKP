<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSkpp extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'jenis_skpp';
    // untuk default id
    protected $primaryKey = 'id_jenis_skpp';
    // untuk fillable
    protected $fillable = [
        'id_jenis_skpp',
        'kode',
        'nama',
        'by_users'
    ];
}