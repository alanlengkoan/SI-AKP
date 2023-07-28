<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'pangkat';
    // untuk default id
    protected $primaryKey = 'id_pangkat';
    // untuk fillable
    protected $fillable = [
        'id_pangkat',
        'nama',
        'by_users'
    ];
}
