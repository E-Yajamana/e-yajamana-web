<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use stdClass;

/**
 * Class TbSulinggih
 *
 * @property int $id
 * @property int $id_griya
 * @property int $id_user
 * @property int|null $nabe
 * @property string|null $nama_walaka
 * @property string|null $nama_sulinggih
 * @property string|null $nama_pasangan
 * @property string|null $tempat_lahir
 * @property Carbon|null $tanggal_lahir
 * @property string|null $jenis_kelamin
 * @property string|null $pekerjaan
 * @property string|null $pendidikan
 * @property Carbon|null $tanggal_diksha
 * @property string|null $status
 * @property string|null $sk_kesulinggihan
 * @property string|null $status_konfirmasi_akun
 * @property string|null $keterangan_konfirmasi_akun
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbUser $tb_user
 * @property TbGriyaRumah $tb_griya_rumah
 * @property TbSulinggih|null $tb_sulinggih
 * @property Collection|TbReservasi[] $tb_reservasis
 * @property Collection|TbSulinggih[] $tb_sulinggihs
 *
 * @package App\Models
 */
class Sulinggih extends Model
{
	protected $table = 'tb_sulinggih';

	protected $casts = [
		'id_griya' => 'int',
		'id_user' => 'int',
		'nabe' => 'int'
	];

	protected $dates = [
		'tanggal_lahir',
		'tanggal_diksha'
	];

	protected $fillable = [
		'id_griya',
		'id_user',
		'id_nabe',
		'id_pasangan',
		'nama_walaka',
		'nama_sulinggih',
		'nama_pasangan',
		'nama_nabe',
		'tanggal_diksha',
		'status',
		'sk_kesulinggihan',
		'status_konfirmasi_akun',
		'keterangan_konfirmasi_akun'
	];

		/**
	 * Prepare a date for array / JSON serialization.
	 *
	 * @param  \DateTimeInterface  $date
	 * @return string
	 */
	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

	public function User()
	{
		return $this->belongsTo(User::class, 'id_user','id');
	}

	public function GriyaRumah()
	{
		return $this->belongsTo(GriyaRumah::class, 'id_griya');
	}

	public function Nabe()
	{
		return $this->belongsTo(Sulinggih::class, 'id_nabe');
	}

    public function Pasangan()
	{
		return $this->belongsTo(Sulinggih::class, 'id_pasangan');
	}

	public function Reservasi()
	{
		return $this->hasMany(Reservasi::class, 'id_relasi','id');
	}

    public function KeteranganKonfirmasi()
	{
		return $this->hasMany(KeteranganKonfirmasi::class, 'id_sulinggih');
	}


    public function getNabeAndPasangan()
    {
        $dataObj = new stdClass;

        if($this->id_nabe != null){
            $relasi = $this->belongsTo(Sulinggih::class, 'id_nabe')->first();
            $dataObj->nama_nabe = $relasi->nama_sulinggih;
        }else{
            $dataObj->nama_nabe = $this->nama_nabe;
        }

        if($this->id_pasangan != null){
            $relasi = $this->belongsTo(Sulinggih::class, 'id_pasangan')->first();
            $dataObj->nama_pasangan = $relasi->nama_walaka;
        }else{
            $dataObj->nama_pasangan = $this->nama_pasangan;
        }

        return $dataObj;
    }

}
