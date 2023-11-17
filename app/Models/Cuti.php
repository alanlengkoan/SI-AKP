<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'cuti';
    // untuk default id
    protected $primaryKey = 'id_cuti';
    // untuk fillable
    protected $fillable = [
        'id_cuti',
        'id_pegawai',
        'tipe_cuti',
        'tgl_mulai',
        'tgl_selesai',
        'by_users'
    ];

    // untuk relasi
    protected $with = [
        'toPegawai'
    ];

    public function toPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
}
