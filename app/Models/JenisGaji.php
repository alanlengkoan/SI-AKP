<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisGaji extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'jenis_gaji';
    // untuk default id
    protected $primaryKey = 'id_jenis_gaji';
    // untuk fillable
    protected $fillable = [
        'id_jenis_gaji',
        'nama',
        'by_users'
    ];
}
