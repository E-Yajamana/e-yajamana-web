<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upacara extends Model
{
    use HasFactory;

    protected $table = 'tb_upacara';

    protected $fillable = [
        'nama_upacara',
        'kategori_upacara',
        'deskripsi_upacara',
        'image',
    ];

    public function TahapanUpacara()
    {
        return $this->hasMany(TahapanUpacara::class, 'id_upacara', 'id');
    }
}
