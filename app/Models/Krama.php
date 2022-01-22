<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKrama
 *
 * @property int $id
 * @property int $id_user
 * @property string $id_desa
 * @property int $id_desa_adat
 * @property string|null $nama_krama
 * @property string|null $alamat_krama
 * @property string|null $jenis_kelamin
 * @property string|null $tempat_lahir
 * @property Carbon|null $tanggal_lahir
 * @property float|null $lat
 * @property float|null $lng
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbUser $tb_user
 * @property TbDesa $tb_desa
 * @property TbDesaadat $tb_desaadat
 * @property Collection|TbUpacaraku[] $tb_upacarakus
 *
 * @package App\Models
 */
class Krama extends Model
{
	protected $table = 'tb_krama';

	protected $casts = [
		'id_user' => 'int',
		'id_desa_adat' => 'int',
		'lat' => 'float',
		'lng' => 'float'
	];

	protected $dates = [
		'tanggal_lahir'
	];

	protected $fillable = [
		'id_user',
		'id_desa',
		'id_desa_adat',
		'nama_krama',
		'alamat_krama',
		'jenis_kelamin',
		'tempat_lahir',
		'tanggal_lahir',
		'lat',
		'lng'
	];

	public function User()
	{
		return $this->belongsTo(User::class, 'id_user','id');
	}

	public function tb_desa()
	{
		return $this->belongsTo(TbDesa::class, 'id_desa','id');
	}

	public function DesaAdat()
	{
		return $this->belongsTo(DesaAdat::class, 'id_desa_adat','id');
	}

	public function Upacaraku()
	{
		return $this->hasMany(Upacaraku::class, 'id_krama');
	}
}
