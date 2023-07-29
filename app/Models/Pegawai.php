<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pegawai';
    // untuk default id
    protected $primaryKey = 'id_pegawai';
    // untuk fillable
    protected $fillable = [
        'id_pegawai',
        'id_agama',
        'id_pangkat',
        'id_pendidikan',
        'nip',
        'tgl_sk',
        'nama',
        'kelamin',
        'tmp_lahir',
        'tgl_lahir',
        'status',
        'by_users',
    ];

    // untuk relasi ke tabel agama
    public function toAgama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    // untuk relasi ke tabel pangkat
    public function toPangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }

    // untuk relasi ke tabel pendidikan
    public function toPendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'id_pendidikan');
    }
}
