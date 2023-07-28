<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsalSuratKeputusan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'asal_surat_keputusan';
    // untuk default id
    protected $primaryKey = 'id_asal_surat_keputusan';
    // untuk fillable
    protected $fillable = [
        'id_asal_surat_keputusan',
        'nama',
        'email',
        'telepon',
        'alamat',
        'fax',
        'website',
        'by_users'
    ];
}
