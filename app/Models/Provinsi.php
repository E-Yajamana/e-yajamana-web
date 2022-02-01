<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'tb_m_provinsi';

    protected $fillable = [
        'name'
    ];

    public function Kabupaten(){
        return $this->hasMany(Kabupaten::class,'provinsi_id','id');
    }

}
