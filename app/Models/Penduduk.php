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
 * @property string|null $nama_panggilan
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
class Penduduk extends Model
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
		'nama',
		'nama_alias',
		'gelar_belakang',
		'gelar_depan',
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

    public function User(){
		return $this->hasOne(User::class,'id_penduduk','id');
	}

	public function AyahKandung(){
		return $this->belongsTo(Penduduk::class,'ayah_kandung_id','id');
	}

	public function IbuKandung(){
		return $this->belongsTo(Penduduk::class,'ibu_kandung_id','id');
	}

	public function Profesi()
	{
		return $this->belongsTo(Profesi::class, 'profesi_id');
	}

	public function Pendidikan()
	{
		return $this->belongsTo(Pendidikan::class, 'pendidikan_id');
	}

	public function KramaMipilDesaAdat()
	{
		return $this->hasMany(KramaMipilDesaAdat::class, 'penduduk_id');
	}

    public function KramaTamiuDesaAdat()
	{
		return $this->hasMany(KramaTamiuDesaAdat::class, 'penduduk_id');
	}

	public function TamiuDesaAdat()
	{
		return $this->hasMany(TamiuDesaAdat::class, 'penduduk_id');
	}

	// public function tb_perkawinans()
	// {
	// 	return $this->hasMany(TbPerkawinan::class, 'pradana_id');
	// }

	// public function tb_super_admins()
	// {
	// 	return $this->hasMany(TbSuperAdmin::class, 'penduduk_id');
	// }

    // public function tb_keluarga_besars()
	// {
	// 	return $this->hasMany(TbKeluargaBesar::class, 'kepala_keluarga_besar_id');
	// }

    // public function tb_mapera()
    // {
    // 	return $this->hasOne(TbMapera::class, 'penduduk_id');
    // }
}
