<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbReservasi
 * 
 * @property int $id
 * @property int $id_relasi
 * @property int $id_upacaraku
 * @property string|null $tipe
 * @property string|null $status
 * @property Carbon|null $tgl_tangkil
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
		'tgl_tangkil'
	];

	protected $fillable = [
		'id_relasi',
		'id_upacaraku',
		'tipe',
		'status',
		'tgl_tangkil',
		'desc'
	];

	public function Sulinggih()
	{
		return $this->belongsTo(Sulinggih::class, 'id_relasi');
	}

	public function Upacaraku()
	{
		return $this->belongsTo(Upacaraku::class, 'id_upacaraku');
	}

	public function DetailReservasi()
	{
		return $this->hasMany(DetailReservasi::class, 'id_reservasi');
	}

	public function Gambars()
	{
		return $this->hasMany(Gambar::class, 'id_reservarsi');
	}
}
