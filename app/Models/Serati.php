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
        'nama_serati',
        'status_konfirmasi_akun',
        'keterangan_konfirmasi_akun',
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

}
