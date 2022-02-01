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
 * Class TbMProfesi
 * 
 * @property int $id
 * @property string|null $profesi
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|TbPenduduk[] $tb_penduduks
 *
 * @package App\Models
 */
class Profesi extends Model
{
	use SoftDeletes;
	protected $table = 'tb_m_profesi';

	protected $fillable = [
		'profesi'
	];

	public function Penduduk()
	{
		return $this->hasMany(Penduduk::class, 'profesi_id');
	}
}