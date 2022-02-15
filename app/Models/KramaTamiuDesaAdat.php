<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TbKramaTamiuDesaAdat
 *
 * @property int $id
 * @property int|null $banjar_adat_id
 * @property int|null $penduduk_id
 * @property int|null $banjar_dinas_id
 * @property string|null $nomor_krama_tamiu
 * @property Carbon|null $tanggal_masuk
 * @property Carbon|null $tanggal_keluar
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property TbMBanjarAdat|null $tb_m_banjar_adat
 * @property TbPenduduk|null $tb_penduduk
 * @property TbMBanjarDina|null $tb_m_banjar_dina
 *
 * @package App\Models
 */
class KramaTamiuDesaAdat extends Model
{
	use SoftDeletes;
	protected $table = 'tb_krama_tamiu_desa_adat';

	protected $casts = [
		'banjar_adat_id' => 'int',
		'penduduk_id' => 'int',
		'banjar_dinas_id' => 'int'
	];

	protected $dates = [
		'tanggal_masuk',
		'tanggal_keluar'
	];

	protected $fillable = [
		'banjar_adat_id',
		'penduduk_id',
		'banjar_dinas_id',
		'nomor_krama_tamiu',
		'tanggal_masuk',
		'tanggal_keluar'
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
}
