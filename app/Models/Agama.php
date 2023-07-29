<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'agama';
    // untuk default id
    protected $primaryKey = 'id_agama';
    // untuk fillable
    protected $fillable = [
        'id_agama',
        'nama',
        'by_users'
    ];
}
