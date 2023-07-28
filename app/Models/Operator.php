<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    // untuk default tabel
    protected $table = 'operator';
    // untuk default id
    protected $primaryKey = 'id_operator';

    // untuk relasi ke tabel users
    public function toUser()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}