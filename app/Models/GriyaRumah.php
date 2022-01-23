<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GriyaRumah extends Model
{
    use HasFactory;

    protected $table = 'tb_griya_rumah';
	protected $primaryKey = 'id';

    protected $fillable = [
        'id_desa',
        'id_desa_adat',
		'nama_griya_rumah',
		'alamat_griya_rumah',
		'lat',
		'lng',
    ];

    public function DesaAdat(){
        return $this->belongsTo(DesaAdat::class,'id_desa_adat','desadat_id');
    }

    public function Desa(){
        return $this->belongsTo(Desa::class,'id_desa','id_desa');
    }

    public function Sulinggih(){
        return $this->hasMany(Sulinggih::class,'id_griya','id');
    }

}
