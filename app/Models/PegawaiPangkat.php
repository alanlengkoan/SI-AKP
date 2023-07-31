<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiPangkat extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pegawai_pangkat';
    // untuk default id
    protected $primaryKey = 'id_pegawai_pangkat';
    // untuk fillable
    protected $fillable = [
        'id_pegawai_pangkat',
        'id_pegawai',
        'id_pangkat',
        'tmt',
        'by_users',
    ];

    // untuk relasi ke tabel pegawai
    public function toPegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    // untuk relasi ke tabel pangkat
    public function toPangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }
}
