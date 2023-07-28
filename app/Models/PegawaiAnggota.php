<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiAnggota extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'pegawai_anggota';
    // untuk default id
    protected $primaryKey = 'id_pegawai_anggota';
    // untuk fillable
    protected $fillable = [
        'id_pegawai_anggota',
        'id_jenis_anggota',
        'id_pegawai',
        'nama',
        'kelamin',
        'tgl_lahir',
        'tmp_lahir',
        'keterangan',
        'status_tanggungan',
        'by_users'
    ];

    // untuk relasi ke tabel jenis_anggota
    public function toJenisAnggota()
    {
        return $this->belongsTo(JenisAnggota::class, 'id_jenis_anggota');
    }
}
