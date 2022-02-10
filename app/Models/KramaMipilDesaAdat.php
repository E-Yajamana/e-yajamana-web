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
 * Class TbKramaMipilDesaAdat
 *
 * @property int $id
 * @property string|null $nomor_krama_mipil
 * @property int|null $banjar_dinas_id
 * @property int|null $banjar_adat_id
 * @property int|null $penduduk_id
 * @property string|null $jenis_kependudukan
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property TbMBanjarAdat|null $tb_m_banjar_adat
 * @property TbPenduduk|null $tb_penduduk
 * @property TbMBanjarDina|null $tb_m_banjar_dina
 * @property Collection|TbAnggotaKeluargaKrama[] $tb_anggota_keluarga_kramas
 * @property Collection|TbPrajuruBanjarAdat[] $tb_prajuru_banjar_adats
 * @property Collection|TbPrajuruDesaAdat[] $tb_prajuru_desa_adats
 *
 * @package App\Models
 */
class KramaMipilDesaAdat extends Model
{
	use SoftDeletes;
	protected $table = 'tb_krama_mipil_desa_adat';

	protected $casts = [
		'banjar_dinas_id' => 'int',
		'banjar_adat_id' => 'int',
		'penduduk_id' => 'int'
	];

	protected $fillable = [
		'nomor_krama_mipil',
		'banjar_dinas_id',
		'banjar_adat_id',
		'penduduk_id',
		'jenis_kependudukan'
	];

	public function BanjarAdat()
	{
		return $this->belongsTo(BanjarAdat::class, 'banjar_adat_id');
	}

	public function Penduduk()
	{
		return $this->belongsTo(Penduduk::class, 'penduduk_id');
	}

	public function BanjarDinas()
	{
		return $this->belongsTo(BanjarDinas::class, 'banjar_dinas_id');
	}

	// public function tb_anggota_keluarga_kramas()
	// {
	// 	return $this->hasMany(TbAnggotaKeluargaKrama::class, 'ibu_id');
	// }

	// public function tb_prajuru_banjar_adats()
	// {
	// 	return $this->hasMany(TbPrajuruBanjarAdat::class, 'krama_mipil_id');
	// }

	// public function tb_prajuru_desa_adats()
	// {
	// 	return $this->hasMany(TbPrajuruDesaAdat::class, 'krama_mipil_id');
	// }

}
