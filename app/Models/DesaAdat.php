<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaAdat extends Model
{
    use HasFactory;

    protected $table = 'tb_desaadat';

    protected $fillable = [
        'desadat_nama',
        'desadat_kode',
        'desadat_bendesa_nama',
        'desadat_penyarikan_nama',
        'desadat_status_aktif',
    ];
}
