<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuGajiTunjangan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'kartu_gaji_tunjangan';
    // untuk default id
    protected $primaryKey = 'id_kartu_gaji_tunjangan';

    // untuk relasi ke tabel tunjangan
    public function toTunjangan()
    {
        return $this->belongsTo(Tunjangan::class, 'id_tunjangan');
    }
}
