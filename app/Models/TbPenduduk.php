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
 * Class TbPenduduk
 * 
 * @property int $id
 * @property string|null $desa_id
 * @property string|null $nomor_induk_krama
 * @property int|null $profesi_id
 * @property int|null $pendidikan_id
 * @property string|null $agama
 * @property string|null $nik
 * @property string|null $gelar_depan
 * @property string|null $nama
 * @property string|null $gelar_belakang
 * @property string|null $nama_alias
 * @property string|null $tempat_lahir
 * @property Carbon|null $tanggal_lahir
 * @property string|null $jenis_kelamin
 * @property string|null $golongan_darah
 * @property string|null $alamat
 * @property Carbon|null $tanggal_kematian
 * @property bool|null $status_perkawinan
 * @property string|null $foto
 * @property int|null $ayah_kandung_id
 * @property int|null $ibu_kandung_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property TbMProfesi|null $tb_m_profesi
 * @property TbMPendidikan|null $tb_m_pendidikan
 * @property TbPenduduk|null $tb_penduduk
 * @property Collection|TbKeluargaBesar[] $tb_keluarga_besars
 * @property Collection|TbKramaMipilDesaAdat[] $tb_krama_mipil_desa_adats
 * @property Collection|TbKramaTamiuDesaAdat[] $tb_krama_tamiu_desa_adats
 * @property TbMapera $tb_mapera
 * @property Collection|TbPenduduk[] $tb_penduduks
 * @property Collection|TbPerkawinan[] $tb_perkawinans
 * @property Collection|TbSuperAdmin[] $tb_super_admins
 * @property Collection|TbTamiuDesaAdat[] $tb_tamiu_desa_adats
 * @property Collection|TbUserEyajamana[] $tb_user_eyajamanas
 *
 * @package App\Models
 */
class TbPenduduk extends Model
{
	use SoftDeletes;
	protected $table = 'tb_penduduk';

	protected $casts = [
		'profesi_id' => 'int',
		'pendidikan_id' => 'int',
		'status_perkawinan' => 'bool',
		'ayah_kandung_id' => 'int',
		'ibu_kandung_id' => 'int'
	];

	protected $dates = [
		'tanggal_lahir',
		'tanggal_kematian'
	];

	protected $fillable = [
		'desa_id',
		'nomor_induk_krama',
		'profesi_id',
		'pendidikan_id',
		'agama',
		'nik',
		'gelar_depan',
		'nama',
		'gelar_belakang',
		'nama_alias',
		'tempat_lahir',
		'tanggal_lahir',
		'jenis_kelamin',
		'golongan_darah',
		'alamat',
		'tanggal_kematian',
		'status_perkawinan',
		'foto',
		'ayah_kandung_id',
		'ibu_kandung_id'
	];

	public function tb_m_profesi()
	{
		return $this->belongsTo(TbMProfesi::class, 'profesi_id');
	}

	public function tb_m_pendidikan()
	{
		return $this->belongsTo(TbMPendidikan::class, 'pendidikan_id');
	}

	public function tb_penduduk()
	{
		return $this->belongsTo(TbPenduduk::class, 'ibu_kandung_id');
	}

	public function tb_keluarga_besars()
	{
		return $this->hasMany(TbKeluargaBesar::class, 'kepala_keluarga_besar_id');
	}

	public function tb_krama_mipil_desa_adats()
	{
		return $this->hasMany(TbKramaMipilDesaAdat::class, 'penduduk_id');
	}

	public function tb_krama_tamiu_desa_adats()
	{
		return $this->hasMany(TbKramaTamiuDesaAdat::class, 'penduduk_id');
	}

	public function tb_mapera()
	{
		return $this->hasOne(TbMapera::class, 'penduduk_id');
	}

	public function tb_penduduks()
	{
		return $this->hasMany(TbPenduduk::class, 'ibu_kandung_id');
	}

	public function tb_perkawinans()
	{
		return $this->hasMany(TbPerkawinan::class, 'pradana_id');
	}

	public function tb_super_admins()
	{
		return $this->hasMany(TbSuperAdmin::class, 'penduduk_id');
	}

	public function tb_tamiu_desa_adats()
	{
		return $this->hasMany(TbTamiuDesaAdat::class, 'penduduk_id');
	}

	public function tb_user_eyajamanas()
	{
		return $this->hasMany(TbUserEyajamana::class, 'id_penduduk');
	}
}
