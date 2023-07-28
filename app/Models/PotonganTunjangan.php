<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotonganTunjangan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'potongan_tunjangan';
    // untuk default id
    protected $primaryKey = 'id_potongan_tunjangan';
    // untuk fillable
    protected $fillable = [
        'id_potongan_tunjangan',
        'id_potongan',
        'id_tunjangan',
        'by_users'
    ];

    // untuk relasi ke tabel potongan
    public function toPotongan()
    {
        return $this->belongsTo(Potongan::class, 'id_potongan');
    }

    // untuk relasi ke tabel tunjangan
    public function toTunjangan()
    {
        return $this->belongsTo(Tunjangan::class, 'id_tunjangan');
    }
}
