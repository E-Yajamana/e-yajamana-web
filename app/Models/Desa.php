<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_desa';
    protected $table = 'tb_desa';

    protected $fillable = [
        'id_desa',
        'id_kecamatan',
        'name',
    ];

    public function Kecamatan(){
        return $this->belongsTo(Kecamatan::class,'id_kecamatan','id_kecamatan');
    }

    public function GriyaRumah()
	{
		return $this->hasMany(Desa::class, 'id_desa','id_desa');
	}
}
