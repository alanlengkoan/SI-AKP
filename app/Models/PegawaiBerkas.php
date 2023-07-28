<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiBerkas extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'pegawai_berkas';
    // untuk default id
    protected $primaryKey = 'id_pegawai_berkas';

    // untuk relasi ke tabel berkas_skpp
    public function toBerkasSkpp()
    {
        return $this->belongsTo(BerkasSkpp::class, 'id_berkas_skpp');
    }
}
