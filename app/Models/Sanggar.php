<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSanggar
 * 
 * @property int $id
 * @property int $id_user
 * @property string $id_desa
 * @property int $id_desa_adat
 * @property string|null $nama_sanggar
 * @property string|null $nama_pengelola
 * @property string|null $alamat_sanggar
 * @property string|null $sk_tanda_usaha
 * @property float|null $lat
 * @property float|null $lng
 * @property string|null $status_konfirmasi_akun
 * @property string|null $keterangan_konfirmasi_akun
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TbUser $tb_user
 * @property TbDesa $tb_desa
 * @property TbDesaadat $tb_desaadat
 *
 * @package App\Models
 */
class Sanggar extends Model
{
	protected $table = 'tb_sanggar';

	protected $casts = [
		'id_user' => 'int',
		'id_desa_adat' => 'int',
		'lat' => 'float',
		'lng' => 'float'
	];

	protected $fillable = [
		'id_user',
		'id_desa',
		'id_desa_adat',
		'nama_sanggar',
		'nama_pengelola',
		'alamat_sanggar',
		'sk_tanda_usaha',
		'lat',
		'lng',
		'status_konfirmasi_akun',
		'keterangan_konfirmasi_akun'
	];

	public function User()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function Desa()
	{
		return $this->belongsTo(Desa::class, 'id_desa','id_desa');
	}

	public function DesaAdat()
	{
		return $this->belongsTo(DesaAdat::class, 'id_desa_adat','desadat_id');
	}

    public function Reservasi()
	{
		return $this->hasMany(Reservasi::class, 'id_relasi','id');
	}

}
