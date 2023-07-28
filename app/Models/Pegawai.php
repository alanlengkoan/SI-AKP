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

    // untuk relasi ke tabel jenis_skpp
    public function toJenisSkpp()
    {
        return $this->belongsTo(JenisSkpp::class, 'id_jenis_skpp');
    }

    // untuk relasi ke tabel asal_surat_keputusan
    public function toAsalSuratKeputusan()
    {
        return $this->belongsTo(AsalSuratKeputusan::class, 'id_asal_surat_keputusan');
    }
}
