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
 * Class TbMBanjarDina
 * 
 * @property int $id
 * @property int|null $desa_adat_id
 * @property string|null $desa_dinas_id
 * @property string|null $kode_banjar_dinas
 * @property string|null $nama_banjar_dinas
 * @property string|null $jenis_banjar_dinas
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property TbMDesaAdat|null $tb_m_desa_adat
 * @property TbMDesaDina|null $tb_m_desa_dina
 * @property Collection|TbGriyaRumah[] $tb_griya_rumahs
 * @property Collection|TbKramaMipilDesaAdat[] $tb_krama_mipil_desa_adats
 * @property Collection|TbKramaTamiuDesaAdat[] $tb_krama_tamiu_desa_adats
 * @property Collection|TbUpacaraku[] $tb_upacarakus
 *
 * @package App\Models
 */
class BanjarDinas extends Model
{
	use SoftDeletes;
	protected $table = 'tb_m_banjar_dinas';

	protected $casts = [
		'desa_adat_id' => 'int'
	];

	protected $fillable = [
		'desa_adat_id',
		'desa_dinas_id',
		'kode_banjar_dinas',
		'nama_banjar_dinas',
		'jenis_banjar_dinas'
	];

	public function DesaAdat()
	{
		return $this->belongsTo(DesaAdat::class, 'desa_adat_id','id');
	}

	public function DesaDinas()
	{
		return $this->belongsTo(DesaDinas::class, 'desa_dinas_id');
	}

	public function GriyaRumah()
	{
		return $this->hasMany(GriyaRumah::class, 'id_banjar_dinas');
	}

	public function KramaMipilDesaAdat()
	{
		return $this->hasMany(KramaMipilDesaAdat::class, 'banjar_dinas_id');
	}

	public function KramaTamiuDesaAdat()
	{
		return $this->hasMany(KramaTamiuDesaAdat::class, 'banjar_dinas_id');
	}

	public function Upacaraku()
	{
		return $this->hasMany(Upacaraku::class, 'id_banjar_dinas');
	}
}