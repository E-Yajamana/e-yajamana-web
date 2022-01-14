<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbProvinsiBaru
 * 
 * @property string $id_provinsi
 * @property string|null $name
 * 
 * @property Collection|TbKabupatenBaru[] $tb_kabupaten_barus
 *
 * @package App\Models
 */
class ProvinsiBaru extends Model
{
	protected $table = 'tb_provinsi_baru';
	protected $primaryKey = 'id_provinsi';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function tb_kabupaten_barus()
	{
		return $this->hasMany(TbKabupatenBaru::class, 'id_provinsi');
	}
}
