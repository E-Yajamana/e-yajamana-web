<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'tb_provinsi_baru';

    protected $fillable = [
        'name',
    ];

    public function Kabupaten(){
        return $this->hasMany(Kabupaten::class,'id_provinsi','id_provinsi');
    }

}
