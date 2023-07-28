<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasSkpp extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'berkas_skpp';
    // untuk default id
    protected $primaryKey = 'id_berkas_skpp';
    // untuk fillable
    protected $fillable = [
        'id_berkas_skpp',
        'nama',
        'jumlah',
        'by_users'
    ];
}
