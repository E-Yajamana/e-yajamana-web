<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'tb_m_kecamatan';

    protected $fillable = [
        'kabupaten_id',
        'name',
    ];

    public function Kabupaten(){
        return $this->belongsTo(Kabupaten::class,'kabupaten_id','id');
    }

    public function DesaDinas(){
        return $this->hasMany(DesaDinas::class,'kecamatan_id','id');
    }
}
