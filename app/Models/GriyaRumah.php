<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbGriyaRumah
 *
 * @property int $id
 * @property string|null $nama_griya_rumah
 * @property string|null $alamat_griya_rumah
 * @property float|null $lat
 * @property float|null $lng
 * @property int|null $id_desa_adat
 * @property string|null $id_desa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbDesaadat|null $tb_desaadat
 * @property TbDesa|null $tb_desa
 * @property Collection|TbSulinggih[] $tb_sulinggihs
 *
 * @package App\Models
 */
class GriyaRumah extends Model
{
	protected $table = 'tb_griya_rumah';

	protected $casts = [
		'lat' => 'float',
		'lng' => 'float',
		'id_banjar_dinas' => 'int'
	];

	protected $fillable = [
		'nama_griya_rumah',
		'alamat_griya_rumah',
		'lat',
		'lng',
		'id_banjar_dinas'
	];

	public function BanjarDinas()
	{
		return $this->belongsTo(BanjarDinas::class, 'id_banjar_dinas');
	}

	public function Sulinggih()
	{
		return $this->hasMany(Sulinggih::class, 'id_griya','id');
	}
}
