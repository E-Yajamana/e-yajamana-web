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
 * Class TbWna
 *
 * @property int $id
 * @property int|null $negara_id
 * @property string|null $nomor_paspor
 * @property string|null $nama
 * @property string|null $jenis_kelamin
 * @property string|null $tempat_lahir
 * @property Carbon|null $tanggal_lahir
 * @property string|null $alamat
 * @property string|null $foto
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property TbMNegara|null $tb_m_negara
 * @property Collection|TbTamiuDesaAdat[] $tb_tamiu_desa_adats
 *
 * @package App\Models
 */
class Wna extends Model
{
	use SoftDeletes;
	protected $table = 'tb_wna';

	protected $casts = [
		'negara_id' => 'int'
	];

	protected $dates = [
		'tanggal_lahir'
	];

	protected $fillable = [
		'negara_id',
		'nomor_paspor',
		'nama',
		'jenis_kelamin',
		'tempat_lahir',
		'tanggal_lahir',
		'alamat',
		'foto'
	];

	public function tb_m_negara()
	{
		return $this->belongsTo(TbMNegara::class, 'negara_id');
	}

	public function TamiuDesaAdat()
	{
		return $this->hasMany(TamiuDesaAdat::class, 'wna_id');
	}
}
