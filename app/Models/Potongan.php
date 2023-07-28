<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'potongan';
    // untuk default id
    protected $primaryKey = 'id_potongan';
    // untuk fillable
    protected $fillable = [
        'id_potongan',
        'nama',
        'persen',
        'status',
        'by_users'
    ];
}
