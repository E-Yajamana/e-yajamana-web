<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'tb_service';

	protected $fillable = [
		'nama_service',
		'deskripsi_service'
	];

    public function Sanggar()
    {
        return $this->belongsToMany(Sanggar::class,'tb_service_sanggar','id_service','id_sanggar')->withTimestamps();
    }
}
