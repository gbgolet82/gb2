<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    // use HasFactory;
    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_akun',
        'id_klasifikasi',
        'id_usaha',
        'akun',
        'created_at',
        'updated_at'
    ];
}
