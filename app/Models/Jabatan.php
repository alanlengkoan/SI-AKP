<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'jabatan';
    // untuk default id
    protected $primaryKey = 'id_jabatan';
    // untuk fillable
    protected $fillable = [
        'id_jabatan',
        'nama',
        'by_users'
    ];
}
