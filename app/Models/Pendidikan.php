<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TbMPendidikan
 *
 * @property int $id
 * @property string|null $jenjang_pendidikan
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|TbPenduduk[] $tb_penduduks
 *
 * @package App\Models
 */
class Pendidikan extends Model
{
	use SoftDeletes;
	protected $table = 'tb_m_pendidikan';

	protected $fillable = [
		'jenjang_pendidikan'
	];

	public function Penduduk()
	{
		return $this->hasMany(Penduduk::class, 'pendidikan_id');
	}
}
