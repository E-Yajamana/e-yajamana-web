<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'tb_desa';

    protected $fillable = [
        'id_desa',
        'id_kecamatan',
        'name',
    ];

    public function Kecamatan(){
        return $this->belongsTo(Kecamatan::class,'id_kecamatan','id_desa');
    }
}
