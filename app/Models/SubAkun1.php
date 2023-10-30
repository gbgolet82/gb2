<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAkun1 extends Model
{
    // use HasFactory;

    protected $table = 'sub_akun_1';
    protected $primaryKey = 'id_sub_akun_1 ';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_sub_akun_1',
        'id_akun',
        'sub_akun_1	',
        'created_at',
        'updated_at'
    ];
}
