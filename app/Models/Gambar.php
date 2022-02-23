<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbGambar
 *
 * @property int $id
 * @property int|null $id_detail_reservarsi
 * @property Carbon|null $tanggal_upload
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbDetailReservasi|null $tb_detail_reservasi
 *
 * @package App\Models
 */
class Gambar extends Model
{
	protected $table = 'tb_gambar';

	protected $casts = [
		'id_detail_reservarsi' => 'int'
	];

	protected $dates = [
		'tanggal_upload'
	];

	protected $fillable = [
		'id_detail_reservarsi',
		'tanggal_upload',
		'image'
	];

	public function DetailReservasi()
	{
		return $this->belongsTo(DetailReservasi::class, 'id_detail_reservarsi');
	}
}
