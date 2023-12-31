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
        'id_users',
        'id_agama',
        'id_jabatan',
        'id_pangkat',
        'id_pendidikan',
        'nip',
        'tmt',
        'kelamin',
        'tmp_lahir',
        'tgl_lahir',
        'status',
        'by_users',
    ];

    // untuk relasi ke tabel users
    public function toUsers()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    // untuk relasi ke tabel agama
    public function toAgama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

    // untuk relasi ke tabel jabatan
    public function toJabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
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

    // untuk relasi ke tabel pegawai_pangkat
    public function toPegawaiPangkat()
    {
        return $this->hasMany(PegawaiPangkat::class, 'id_pegawai');
    }
}
