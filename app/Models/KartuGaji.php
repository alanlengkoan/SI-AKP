<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuGaji extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'kartu_gaji';
    // untuk default id
    protected $primaryKey = 'id_kartu_gaji';

    // untuk relasi ke tabel ampra_gaji
    public function toAmpraGaji()
    {
        return $this->belongsTo(AmpraGaji::class, 'id_ampra_gaji');
    }

    // untuk relasi ke tabel jenis_gaji
    public function toJenisGaji()
    {
        return $this->belongsTo(JenisGaji::class, 'id_jenis_gaji');
    }
}
