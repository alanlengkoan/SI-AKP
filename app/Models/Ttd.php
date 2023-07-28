<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttd extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'ttd';
    // untuk default id
    protected $primaryKey = 'id_ttd';
    // untuk fillable
    protected $fillable = [
        'id_ttd',
        'id_jabatan',
        'id_pangkat',
        'nip',
        'nama',
        'status',
        'by_users'
    ];

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
}
