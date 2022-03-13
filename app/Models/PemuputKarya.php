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
 * Class TbPemuputKarya
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_griya
 * @property int|null $id_pasangan
 * @property int $id_atribut
 * @property string|null $nama_pemuput
 * @property string|null $status_konfirmasi_akun
 * @property string|null $keterangan_konfirmasi_akun
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbUserEyajamana $tb_user_eyajamana
 * @property TbGriyaRumah $tb_griya_rumah
 * @property TbPemuputKarya|null $tb_pemuput_karya
 * @property TbAtributPemuput $tb_atribut_pemuput
 * @property Collection|TbAtributPemuput[] $tb_atribut_pemuputs
 * @property Collection|TbPemuputKarya[] $tb_pemuput_karyas
 *
 * @package App\Models
 */
class PemuputKarya extends Model
{
	protected $table = 'tb_pemuput_karya';

	protected $casts = [
		'id_user' => 'int',
		'id_griya' => 'int',
		'id_pasangan' => 'int',
		'id_atribut' => 'int'
	];

	protected $fillable = [
		'id_user',
		'id_griya',
		'id_pasangan',
		'id_atribut',
		'nama_pemuput',
		'status_konfirmasi_akun',
		'keterangan_konfirmasi_akun'
	];

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

    public function Pasangan()
	{
		return $this->belongsTo(PemuputKarya::class, 'id_pasangan');
	}

	public function AtributPemuput()
	{
		return $this->belongsTo(AtributPemuput::class, 'id_atribut');
	}

	public function Nabe()
	{
		return $this->hasMany(AtributPemuput::class, 'id_nabe');
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
