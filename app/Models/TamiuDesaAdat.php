<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TbTamiuDesaAdat
 *
 * @property int $id
 * @property int|null $banjar_adat_id
 * @property int|null $banjar_dinas_id
 * @property string|null $nomor_tamiu
 * @property Carbon|null $tanggal_masuk
 * @property Carbon|null $tanggal_keluar
 * @property int|null $penduduk_id
 * @property int|null $wna_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @property TbWna|null $tb_wna
 * @property TbPenduduk|null $tb_penduduk
 *
 * @package App\Models
 */
class TamiuDesaAdat extends Model
{
	use SoftDeletes;
	protected $table = 'tb_tamiu_desa_adat';

	protected $casts = [
		'banjar_adat_id' => 'int',
		'banjar_dinas_id' => 'int',
		'penduduk_id' => 'int',
		'wna_id' => 'int'
	];

	protected $dates = [
		'tanggal_masuk',
		'tanggal_keluar'
	];

	protected $fillable = [
		'banjar_adat_id',
		'banjar_dinas_id',
		'nomor_tamiu',
		'tanggal_masuk',
		'tanggal_keluar',
		'penduduk_id',
		'wna_id'
	];

	public function Wna()
	{
		return $this->belongsTo(Wna::class, 'wna_id');
	}

	public function Penduduk()
	{
		return $this->belongsTo(Penduduk::class, 'penduduk_id');
	}
}
