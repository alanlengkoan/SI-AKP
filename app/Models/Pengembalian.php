<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'pengembalian';
    // untuk default id
    protected $primaryKey = 'id_pengembalian';

    // untuk relasi ke tabel pegawai_anggota
    public function toPegawaiAnggota()
    {
        return $this->belongsTo(PegawaiAnggota::class, 'id_pegawai_anggota');
    }

    // untuk relasi ke tabel jenis_gaji
    public function toJenisGaji()
    {
        return $this->belongsTo(JenisGaji::class, 'id_jenis_gaji');
    }

    // untuk relasi ke tabel tunjangan
    public function toTunjangan()
    {
        return $this->belongsTo(Tunjangan::class, 'id_tunjangan');
    }
}
