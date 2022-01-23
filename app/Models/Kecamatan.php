<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'tb_kecamatan';
    protected $primaryKey = 'id_kecamatan';

    protected $fillable = [
        'id_kecamatan',
        'id_kabupaten',
        'name',
    ];

    public function Kabupaten(){
        return $this->belongsTo(Kabupaten::class,'id_kabupaten','id_kabupaten');
    }

    public function Desa(){
        return $this->hasMany(Desa::class,'id_kecamatan','id_kecamatan');
    }
}
