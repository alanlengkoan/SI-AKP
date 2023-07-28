<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TKartuGajiTunjangan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 't_kartu_gaji_tunjangan';
    // untuk default id
    protected $primaryKey = 'id_t_kartu_gaji_tunjangan';
}
