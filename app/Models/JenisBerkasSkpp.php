<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBerkasSkpp extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'jenis_berkas_skpp';
    // untuk default id
    protected $primaryKey = 'id_jenis_berkas_skpp';
    // untuk fillable
    protected $fillable = [
        'id_jenis_berkas_skpp',
        'id_jenis_skpp',
        'id_berkas_skpp',
        'by_users'
    ];

    // untuk relasi ke tabel jenis_skpp
    public function toJenisSkpp()
    {
        return $this->belongsTo(JenisSkpp::class, 'id_jenis_skpp');
    }

    // untuk relasi ke tabel berkas_skpp
    public function toBerkasSkpp()
    {
        return $this->belongsTo(BerkasSkpp::class, 'id_berkas_skpp');
    }
}
