<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * Class TbUpacaraku
 *
 * @property int $id
 * @property int $id_upacara
 * @property int $id_krama
 * @property string $id_desa
 * @property int $id_desa_adat
 * @property string|null $nama_upacara
 * @property string|null $lokasi
 * @property Carbon|null $tanggal_mulai
 * @property Carbon|null $tanggal_selesai
 * @property string|null $desc
 * @property string|null $status
 * @property float|null $lat
 * @property float|null $lng
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbKrama $tb_krama
 * @property TbUpacara $tb_upacara
 * @property TbDesa $tb_desa
 * @property TbDesaadat $tb_desaadat
 * @property Collection|TbReservasi[] $tb_reservasis
 *
 * @package App\Models
 */
class Upacaraku extends Model
{
	protected $table = 'tb_upacaraku';

	protected $casts = [
		'id_upacara' => 'int',
		'id_krama' => 'int',
		'id_desa_adat' => 'int',
		'lat' => 'float',
		'lng' => 'float'
	];

	protected $dates = [
		'tanggal_mulai',
		'tanggal_selesai'
	];

	protected $fillable = [
		'id_banjar_dinas',
		'id_upacara',
		'id_krama',
		'nama_upacara',
		'alamat_upacaraku',
		'tanggal_mulai',
		'tanggal_selesai',
		'deskripsi_upacaraku',
		'status',
		'lat',
		'lng'
	];

	/**
	 * Prepare a date for array / JSON serialization.
	 *
	 * @param  \DateTimeInterface  $date
	 * @return string
	 */
	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function Krama()
	{
		return $this->belongsTo(Krama::class, 'id_krama');
	}

	public function Upacara()
	{
		return $this->belongsTo(Upacara::class, 'id_upacara','id');
	}


	public function BanjarDinas()
	{
		return $this->belongsTo(BanjarDinas::class, 'id_banjar_dinas');
	}

	public function Reservasi()
	{
		return $this->hasMany(Reservasi::class, 'id_upacaraku','id');
	}
}
