<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmpraGaji extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'ampra_gaji';
    // untuk default id
    protected $primaryKey = 'id_ampra_gaji';

    // untuk relasi ke tabel pegawai
    public function toPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    // untuk relasi ke tabel ttd
    public function toTtd()
    {
        return $this->belongsTo(Ttd::class, 'id_ttd');
    }
}
