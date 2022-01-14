<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbDesa
 * 
 * @property string $id_desa
 * @property string|null $id_kecamatan
 * @property string|null $name
 * 
 * @property TbKecamatan|null $tb_kecamatan
 * @property Collection|TbGriyaRumah[] $tb_griya_rumahs
 *
 * @package App\Models
 */
class Desa extends Model
{
	protected $table = 'tb_desa';
	protected $primaryKey = 'id_desa';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'id_kecamatan',
		'name'
	];

	public function tb_kecamatan()
	{
		return $this->belongsTo(TbKecamatan::class, 'id_kecamatan');
	}

	public function tb_griya_rumahs()
	{
		return $this->hasMany(TbGriyaRumah::class, 'id_desa');
	}
}
