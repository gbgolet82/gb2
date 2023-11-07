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

    public function buktiValid()
    {
        return $this->hasMany(BuktiValid::class, 'id_akun');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($akun) {
            // Hapus data terkait pada tabel BuktiValid
            $akun->buktiValid()->delete();
        });
    }
}
