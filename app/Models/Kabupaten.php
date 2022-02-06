<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'tb_m_kabupaten';

    protected $fillable = [
        'provinsi_id',
        'name',
    ];

    public function Provinsi(){
        return $this->belongsTo(Provinsi::class,'provinsi_id','id');
    }

    public function Kecamatan(){
        return $this->hasMany(Kecamatan::class,'kabupaten_id','id');
    }


}
