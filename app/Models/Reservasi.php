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
 * Class TbReservasi
 *
 * @property int $id
 * @property int $id_relasi
 * @property int $id_upacaraku
 * @property string|null $tipe
 * @property string|null $status
 * @property Carbon|null $tanggal_tangkil
 * @property string|null $desc
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbSulinggih $tb_sulinggih
 * @property TbUpacaraku $tb_upacaraku
 * @property Collection|TbDetailReservasi[] $tb_detail_reservasis
 * @property Collection|TbGambar[] $tb_gambars
 *
 * @package App\Models
 */
class Reservasi extends Model
{
	protected $table = 'tb_reservasi';

	protected $casts = [
		'id_relasi' => 'int',
		'id_upacaraku' => 'int'
	];

	protected $dates = [
		'tanggal_tangkil'
	];

	protected $fillable = [
		'id_relasi',
		'id_upacaraku',
		'tipe',
		'status',
		'tanggal_tangkil',
		'keterangan'
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

	// public function Sanggar()
	// {
	// 	return $this->belongsTo(Sanggar::class, 'id_relasi','id');
	// }

	// public function Sulinggih()
	// {
	// 	return $this->belongsTo(Sulinggih::class, 'id_relasi','id');
	// }

	public function Upacaraku()
	{
		return $this->belongsTo(Upacaraku::class, 'id_upacaraku', 'id');
	}

	public function DetailReservasi()
	{
		return $this->hasMany(DetailReservasi::class, 'id_reservasi', 'id');
	}

	public function Relasi()
	{
		return $this->belongsTo(User::class, 'id_relasi');
	}


	// public function tb_gambars()
	// {
	// 	return $this->hasMany(TbGambar::class, 'id_reservarsi');
	// }
}
