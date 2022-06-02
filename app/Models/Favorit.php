<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TbFavorit
 * 
 * @property int $id
 * @property int|null $id_pemuput_karya
 * @property int|null $id_sanggar
 * @property int|null $id_user
 * 
 * @property TbPemuputKarya|null $tb_pemuput_karya
 * @property TbSanggar|null $tb_sanggar
 * @property TbUserEyajamana|null $tb_user_eyajamana
 *
 * @package App\Models
 */
class Favorit extends Model
{
	protected $table = 'tb_favorit';
	public $timestamps = false;

	protected $casts = [
		'id_pemuput_karya' => 'int',
		'id_sanggar' => 'int',
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_pemuput_karya',
		'id_sanggar',
		'id_user'
	];

	public function PemuputKarya()
	{
		return $this->belongsTo(TbPemuputKarya::class, 'id_pemuput_karya');
	}

	public function Sanggar()
	{
		return $this->belongsTo(TbSanggar::class, 'id_sanggar');
	}

	public function User()
	{
		return $this->belongsTo(TbUserEyajamana::class, 'id_user');
	}
}
