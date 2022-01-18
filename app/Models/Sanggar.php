<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanggar extends Model
{
    use HasFactory;

    protected $table = 'tb_sanggar';

    protected $fillable = [
        'id_user',
        'id_desa',
        'id_desa_adat',
        'nama_sanggar',
        'nama_pengelola',
        'alamat_sanggar',
        'sk_tanda_usaha',
        'status_konfirmasi',
        'lat',
        'lng'
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

}
