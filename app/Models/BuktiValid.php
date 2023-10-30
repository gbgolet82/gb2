<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiValid extends Model
{
    // use HasFactory;

    protected $table = 'bukti_valid';
    protected $primaryKey = 'id_bukti_valid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_bukti_valid',
        'id_akun',
        'bukti_valid_100rb',
        'bukti_valid_lebih100rb',
        'created_at',
        'updated_at'
    ];
}