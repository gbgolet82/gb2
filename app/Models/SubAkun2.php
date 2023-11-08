<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAkun2 extends Model
{
    // use HasFactory;
    protected $table = 'sub_akun_2';
    protected $primaryKey = 'id_sub_akun_2';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_sub_akun_2',
        'id_sub_akun_1',
        'sub_akun_2',
        'created_at',
        'updated_at'
    ];
}
