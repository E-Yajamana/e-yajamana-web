<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapanUpacara extends Model
{
    use HasFactory;

    protected $table = 'tb_tahapan_upacara';

    protected $fillable = [
        'id_upacara',
        'nama_tahapan',
        'deskripsi_tahapan',
        'status_tahapan',
        'image'
    ];

    public function Upacara(){
        return $this->belongsTo(Upacara::class,'id_upacara','id');
    }

    public function DetailReservasi()
	{
		return $this->hasMany(DetailReservasi::class, 'id_tahapan_upacara');
	}

}
