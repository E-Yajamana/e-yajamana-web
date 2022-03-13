<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbAtributPemuput
 *
 * @property int $id
 * @property int $id_nabe
 * @property string|null $sk_pemuput
 * @property Carbon|null $tanggal_diksha
 *
 * @property TbPemuputKarya $tb_pemuput_karya
 * @property Collection|TbPemuputKarya[] $tb_pemuput_karyas
 *
 * @package App\Models
 */
class AtributPemuput extends Model
{
	protected $table = 'tb_atribut_pemuput';
	public $timestamps = false;

	protected $casts = [
		'id_nabe' => 'int'
	];

	protected $dates = [
		'tanggal_diksha'
	];

	protected $fillable = [
		'id_nabe',
		'sk_pemuput',
		'tanggal_diksha'
	];

	public function Nabe()
	{
		return $this->belongsTo(PemuputKarya::class, 'id_nabe');
	}

	public function PemuputKarya()
	{
		return $this->hasMany(PemuputKarya::class, 'id_atribut');
	}
}
