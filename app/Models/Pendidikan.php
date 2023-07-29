<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'pendidikan';
    // untuk default id
    protected $primaryKey = 'id_pendidikan';
    // untuk fillable
    protected $fillable = [
        'id_pendidikan',
        'nama',
        'by_users'
    ];
}
