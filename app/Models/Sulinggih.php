<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sulinggih extends Model
{
    use HasFactory;

    protected $table = 'tb_sulinggih';

    protected $fillable = [
        'id_griya',
        'id_user',
        'nabe',
        'nama_walaka',
        'nama_sulinggih',
        'nama_pasangan',
        'tempat_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_lahir',
        'pendidikan',
        'tanggal_diksha',
        'sk_kesulinggihan',
        'status_konfirmasi_akun',
        'sk_kesulinggihan',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

}
