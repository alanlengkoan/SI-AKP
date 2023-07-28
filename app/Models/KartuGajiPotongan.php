<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuGajiPotongan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'kartu_gaji_potongan';
    // untuk default id
    protected $primaryKey = 'id_kartu_gaji_potongan';

    // untuk relasi ke tabel potongan
    public function toPotongan()
    {
        return $this->belongsTo(Potongan::class, 'id_potongan');
    }
}
