<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbDesaadat
 * 
 * @property int $desadat_id
 * @property int|null $desadat_jenis_id
 * @property string|null $desadat_nama
 * @property string|null $desadat_kode
 * @property float|null $desadat_kantor_long
 * @property float|null $desadat_kantor_lat
 * @property string|null $desadat_bendesa_nama
 * @property string|null $desadat_penyarikan_nama
 * @property string|null $desadat_petengen
 * @property string|null $desadat_nomor_register
 * @property string|null $desadat_alamat_kantor
 * @property string|null $desadat_telpon_kantor
 * @property string|null $desadat_fax_kantor
 * @property string|null $desadat_email
 * @property string|null $desadat_web
 * @property float|null $desadat_luas
 * @property string|null $desadat_sejarah
 * @property string|null $desadat_file_struktur_pem
 * @property string|null $desadat_hp_kontak1
 * @property string|null $desadat_hp_kontak2
 * @property string|null $desadat_wa_kontak_1
 * @property string|null $desadat_wa_kontak_2
 * @property int|null $kecamatan_id
 * @property int|null $kabkot_id
 * @property string|null $desadat_ttd_lokasi
 * @property int|null $desadat_punya_lpd
 * @property int|null $desadat_jum_staf
 * @property int|null $desadat_jum_banjar
 * @property int|null $desadat_jum_kk_mipil
 * @property int|null $desadat_jum_krama_mipil
 * @property int|null $desadat_jum_kk_krama_tamiu
 * @property int|null $desadat_jum_krama_tamiu
 * @property int|null $desadat_jum_kk_tamiu
 * @property int|null $desadat_jum_tamiu
 * @property string|null $desadat_sebutan_pemimpin
 * @property bool|null $desadat_status_aktif
 * @property string|null $password_temp
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TbGriyaRumah[] $tb_griya_rumahs
 *
 * @package App\Models
 */
class Desaadat extends Model
{
	protected $table = 'tb_desaadat';
	protected $primaryKey = 'desadat_id';

	protected $casts = [
		'desadat_jenis_id' => 'int',
		'desadat_kantor_long' => 'float',
		'desadat_kantor_lat' => 'float',
		'desadat_luas' => 'float',
		'kecamatan_id' => 'int',
		'kabkot_id' => 'int',
		'desadat_punya_lpd' => 'int',
		'desadat_jum_staf' => 'int',
		'desadat_jum_banjar' => 'int',
		'desadat_jum_kk_mipil' => 'int',
		'desadat_jum_krama_mipil' => 'int',
		'desadat_jum_kk_krama_tamiu' => 'int',
		'desadat_jum_krama_tamiu' => 'int',
		'desadat_jum_kk_tamiu' => 'int',
		'desadat_jum_tamiu' => 'int',
		'desadat_status_aktif' => 'bool'
	];

	protected $fillable = [
		'desadat_jenis_id',
		'desadat_nama',
		'desadat_kode',
		'desadat_kantor_long',
		'desadat_kantor_lat',
		'desadat_bendesa_nama',
		'desadat_penyarikan_nama',
		'desadat_petengen',
		'desadat_nomor_register',
		'desadat_alamat_kantor',
		'desadat_telpon_kantor',
		'desadat_fax_kantor',
		'desadat_email',
		'desadat_web',
		'desadat_luas',
		'desadat_sejarah',
		'desadat_file_struktur_pem',
		'desadat_hp_kontak1',
		'desadat_hp_kontak2',
		'desadat_wa_kontak_1',
		'desadat_wa_kontak_2',
		'kecamatan_id',
		'kabkot_id',
		'desadat_ttd_lokasi',
		'desadat_punya_lpd',
		'desadat_jum_staf',
		'desadat_jum_banjar',
		'desadat_jum_kk_mipil',
		'desadat_jum_krama_mipil',
		'desadat_jum_kk_krama_tamiu',
		'desadat_jum_krama_tamiu',
		'desadat_jum_kk_tamiu',
		'desadat_jum_tamiu',
		'desadat_sebutan_pemimpin',
		'desadat_status_aktif',
		'password_temp'
	];

	public function tb_griya_rumahs()
	{
		return $this->hasMany(TbGriyaRumah::class, 'id_desa_adat');
	}
}
