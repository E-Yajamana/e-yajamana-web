<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKecamatan
 * 
 * @property string $id_kecamatan
 * @property string|null $id_kabupaten
 * @property string|null $name
 * 
 * @property TbKabupatenBaru|null $tb_kabupaten_baru
 * @property Collection|TbDesa[] $tb_desas
 *
 * @package App\Models
 */
class Kecamatan extends Model
{
	protected $table = 'tb_kecamatan';
	protected $primaryKey = 'id_kecamatan';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'id_kabupaten',
		'name'
	];

	public function tb_kabupaten_baru()
	{
		return $this->belongsTo(TbKabupatenBaru::class, 'id_kabupaten');
	}

	public function tb_desas()
	{
		return $this->hasMany(TbDesa::class, 'id_kecamatan');
	}
}
