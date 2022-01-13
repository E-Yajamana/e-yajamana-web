<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krama extends Model
{
    use HasFactory;

    protected $table = 'tb_krama';

    protected $fillable = [
        'id_user',
        'nama_krama',
        'alamat_krama',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    public function User(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function Upacaraku(){
        return $this->hasMany(Upacaraku::class,'id_krama','id');
    }
}
