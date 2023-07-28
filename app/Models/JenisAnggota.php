<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAnggota extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'jenis_anggota';
    // untuk default id
    protected $primaryKey = 'id_jenis_anggota';
    // untuk fillable
    protected $fillable = [
        'id_jenis_anggota',
        'nama',
        'by_users'
    ];
}
