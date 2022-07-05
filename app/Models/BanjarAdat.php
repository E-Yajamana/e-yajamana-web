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
 * Class TbMBanjarAdat
 *
 * @property int $id
 * @property int|null $desa_adat_id
 * @property string|null $kode_banjar_adat
 * @property string|null $nama_banjar_adat
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property Collection|TbKeluargaBesar[] $tb_keluarga_besars
 * @property Collection|TbKeluargaKrama[] $tb_keluarga_kramas
 * @property Collection|TbKramaMipilDesaAdat[] $tb_krama_mipil_desa_adats
 * @property Collection|TbKramaTamiuDesaAdat[] $tb_krama_tamiu_desa_adats
 * @property Collection|TbPrajuruBanjarAdat[] $tb_prajuru_banjar_adats
 *
 * @package App\Models
 */
class BanjarAdat extends Model
{
	use SoftDeletes;
	protected $table = 'tb_m_banjar_adat';

	protected $casts = [
		'desa_adat_id' => 'int'
	];

	protected $fillable = [
		'desa_adat_id',
		'kode_banjar_adat',
		'nama_banjar_adat'
	];

	// public function tb_keluarga_besars()
	// {
	// 	return $this->hasMany(TbKeluargaBesar::class, 'banjar_adat_id');
	// }

	// public function tb_keluarga_kramas()
	// {
	// 	return $this->hasMany(TbKeluargaKrama::class, 'banjar_adat_id');
	// }

	public function KramaMipilDesaAdat()
	{
		return $this->hasMany(KramaMipilDesaAdat::class, 'banjar_adat_id');
	}

	public function KramaTamiuDesaAdat()
	{
		return $this->hasMany(KramaTamiuDesaAdat::class, 'banjar_adat_id');
	}

	// public function tb_prajuru_banjar_adats()
	// {
	// 	return $this->hasMany(TbPrajuruBanjarAdat::class, 'banjar_adat_id');
	// }
}
