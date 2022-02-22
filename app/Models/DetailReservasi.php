<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * Class TbDetailReservasi
 *
 * @property int $id
 * @property int $id_reservasi
 * @property int $id_tahapan_upacara
 * @property Carbon|null $tanggal_mulai
 * @property Carbon|null $tanggal_selesai
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbReservasi $tb_reservasi
 * @property TbTahapanUpacara $tb_tahapan_upacara
 *
 * @package App\Models
 */
class DetailReservasi extends Model
{
	protected $table = 'tb_detail_reservasi';

	protected $casts = [
		'id_reservasi' => 'int',
		'id_tahapan_upacara' => 'int'
	];

	protected $dates = [
		'tanggal_mulai',
		'tanggal_selesai'
	];

	protected $fillable = [
		'id_reservasi',
		'id_tahapan_upacara',
		'tanggal_mulai',
		'tanggal_selesai',
		'keterangan',
		'status'
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

	public function Reservasi()
	{
		return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id');
	}

	public function TahapanUpacara()
	{
		return $this->belongsTo(TahapanUpacara::class, 'id_tahapan_upacara', 'id');
	}

	public function KeteranganKonfirmasi()
	{
		return $this->hasMany(KeteranganKonfirmasi::class, 'id_detail_reservasi');
	}
}
