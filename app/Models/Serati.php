<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serati extends Model
{
    use HasFactory;

    protected $table = 'tb_serati';

    protected $fillable = [
        'id_user',
        'id_desa',
        'id_desa_adat',
        'nama_serati',
        'alamat_serati',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'status_konfirmasi_akun',
        'keterangan_konfirmasi_akun',
        'lat',
        'lng'
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }


}
