<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upacaraku extends Model
{
    use HasFactory;

    protected $table = 'tb_upacaraku';

    protected $fillable = [
        'id_upacara',
        'id_krama',
        'nama_upacara',
        'lokasi',
        'lat',
        'lng',
        'tanggal_mulai',
        'tanggal_selesai',
        'desc',
    ];

    public function Upacara(){
        return $this->belongsTo(Upacara::class,'id_upacara','id');
    }
}
