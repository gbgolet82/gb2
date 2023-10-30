<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAkun3 extends Model
{
    // use HasFactory;
    protected $table = 'sub_akun_3';
    protected $primaryKey = 'id_sub_akun_3';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_sub_akun_3',
        'id_akun',
        'sub_akun_3	',
        'created_at',
        'updated_at'
    ];
}
