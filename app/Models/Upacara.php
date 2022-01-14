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
        'katagori_upacara',
        'deskripsi_upacara',
        'image',
    ];


}
