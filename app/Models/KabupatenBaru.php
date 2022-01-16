<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKabupatenBaru
 * 
 * @property string $id_kabupaten
 * @property string|null $id_provinsi
 * @property string|null $name
 * 
 * @property TbProvinsiBaru|null $tb_provinsi_baru
 * @property Collection|TbKecamatan[] $tb_kecamatans
 *
 * @package App\Models
 */
class KabupatenBaru extends Model
{
	protected $table = 'tb_kabupaten_baru';
	protected $primaryKey = 'id_kabupaten';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'id_provinsi',
		'name'
	];

	public function tb_provinsi_baru()
	{
		return $this->belongsTo(Provinsi::class, 'id_provinsi');
	}

	public function tb_kecamatans()
	{
		return $this->hasMany(TbKecamatan::class, 'id_kabupaten');
	}
}
