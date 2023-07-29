<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gapok extends Model
{
    use HasFactory;
    // untuk default tabel
    protected $table = 'gapok';
    // untuk default id
    protected $primaryKey = 'id_gapok';
    // untuk fillable
    protected $fillable = [
        'id_gapok',
        'id_pangkat',
        'dari',
        'sampai',
        'gaji',
        'by_users'
    ];

    // untuk relasi tabel ke pangkat
    public function toPangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat', 'id_pangkat');
    }
}
