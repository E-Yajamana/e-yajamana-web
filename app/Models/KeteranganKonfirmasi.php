<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKeteranganKonfirmasi
 *
 * @property int $id
 * @property int $id_sulinggih
 * @property int $id_detail_reservasi
 * @property string|null $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbSulinggih $tb_sulinggih
 * @property TbDetailReservasi $tb_detail_reservasi
 *
 * @package App\Models
 */
class KeteranganKonfirmasi extends Model
{
	protected $table = 'tb_keterangan_konfirmasi';

	protected $casts = [
		'id_sulinggih' => 'int',
		'id_detail_reservasi' => 'int'
	];

	protected $fillable = [
		'id_sulinggih',
		'id_detail_reservasi',
		'keterangan'
	];

	public function Relasi()
	{
		return $this->belongsTo(User::class, 'id_sulinggih');
	}

	public function DetailReservasi()
	{
		return $this->belongsTo(DetailReservasi::class, 'id_detail_reservasi','id');
	}
}
