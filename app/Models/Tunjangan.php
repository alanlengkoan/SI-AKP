<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunjangan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'tunjangan';
    // untuk default id
    protected $primaryKey = 'id_tunjangan';
    // untuk fillable
    protected $fillable = [
        'id_tunjangan',
        'nama',
        'by_users'
    ];
}
