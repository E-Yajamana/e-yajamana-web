<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaDinas extends Model
{
    use HasFactory;

    protected $table = 'tb_m_desa_dinas';

    protected $fillable = [
        'kecamatan_id',
        'name',
    ];

    public function Kecamatan(){
        return $this->belongsTo(Kecamatan::class,'kecamatan_id','id');
    }

    public function BanjarDinas(){
        return $this->hasMany(BanjarDinas::class,'desa_dinas_id','id');
    }

    public function Sanggar(){
        return $this->hasMany(Sanggar::class,'id_desa_dinas','id');
    }

}
