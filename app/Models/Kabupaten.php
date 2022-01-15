<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'tb_kabupaten_baru';

    protected $fillable = [
        'id_kabupaten',
        'id_provinsi',
        'name',
    ];

    public function Provinsi(){
        return $this->belongsTo(Provinsi::class,'id_provinsi','id_provinsi');
    }

    public function Kecamatan(){
        return $this->hasMany(Kecamatan::class,'id_kabupaten','id_kabupaten');
    }


}
