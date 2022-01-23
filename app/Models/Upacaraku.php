<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upacaraku extends Model
{
    use HasFactory;

    protected $table = 'tb_upacaraku';

    protected $fillable = [
        'id',
        'id_krama',
        'id_desa',
        'id_desa_adat',
        'id_upacara',
        'nama_upacara',
        'lokasi',
        'lat',
        'lng',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'desc',
    ];

    public function Upacara(){
        return $this->belongsTo(Upacara::class,'id_upacara','id');
    }

    public function Desa(){
        return $this->belongsTo(Desa::class,'id_desa','id_desa');
    }

    public function DesaAdat(){
        return $this->belongsTo(DesaAdat::class,'id_desa_adat','desadat_id');
    }

    public function Reservasi(){
        return $this->hasMany(Reservasi::class,'id_upacaraku','id');
    }
}