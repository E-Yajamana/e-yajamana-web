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
        'desc_tahapan',
        'status_upacara'
    ];
}
