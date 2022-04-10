<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Session;
use stdClass;

/**
 * Class TbUserEyajamana
 *
 * @property int $id
 * @property int|null $id_penduduk
 * @property string $email
 * @property string $password
 * @property string $nomor_telepon
 * @property string|null $user_profile
 * @property string|null $json_token_lupa_password
 * @property string|null $fcm_token_key
 * @property string|null $fcm_token_web
 * @property float|null $lat
 * @property float|null $lng
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbPenduduk|null $tb_penduduk
 * @property Collection|TbKepemilikanSanggar[] $tb_kepemilikan_sanggars
 * @property Collection|TbKeteranganKonfirmasi[] $tb_keterangan_konfirmasis
 * @property Collection|TbPemuputKarya[] $tb_pemuput_karyas
 * @property Collection|TbReservasi[] $tb_reservasis
 * @property Collection|TbSerati[] $tb_seratis
 * @property Collection|TbUpacaraku[] $tb_upacarakus
 * @property Collection|TbUserRole[] $tb_user_roles
 *
 * @package App\Models
 */


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_user_eyajamana';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'id_penduduk',
		'email',
		'password',
		'nomor_telepon',
		'user_profile',
		'json_token_lupa_password',
		'fcm_token_key',
		'fcm_token_web',
		'lat',
		'lng'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
		'json_token_lupa_password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id_penduduk' => 'int',
		'lat' => 'float',
		'lng' => 'float'
    ];

    public function Penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id');
    }

    public function PemuputKarya()
    {
        return $this->hasOne(PemuputKarya::class, 'id_user', 'id');
    }

    public function Serati()
    {
        return $this->hasOne(Serati::class, 'id_user', 'id');
    }

    public function Reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_relasi');
    }

    public function KeteranganKonfirmasi()
    {
        return $this->hasMany(KeteranganKonfirmasi::class, 'id_relasi');
    }

    public function Upacaraku()
	{
		return $this->hasMany(Upacaraku::class, 'id_krama');
	}

    public function Role()
    {
        return $this->belongsToMany(Role::class,'tb_user_roles','id_user','id_role')->withTimestamps();
    }

    public function Sanggar()
    {
        return $this->belongsToMany(Sanggar::class,'tb_kepemilikan_sanggar','id_user','id_sanggar')->withTimestamps();
    }

    // public function getRelasi($role)
    // {
    //     switch ($role) {
    //         case 'pemuput_karya':
    //             $relasi =  $this->hasOne(PemuputKarya::class, 'id_user', 'id')->first();
    //             $dataObj = new stdClass;
    //             $dataObj->nama = $relasi->nama_pemuput;
    //             return $dataObj;
    //             break;
    //         case 'sanggar':
    //             $relasi =  $this->hasOne(Sanggar::class, 'id_user', 'id')->first();
    //             $dataObj = new stdClass;
    //             $dataObj->nama = $relasi->nama_sanggar;
    //             return $dataObj;
    //             break;
    //         default:
    //             return null;
    //             break;
    //     }
    // }

    public function sessionSanggar()
    {
        $session = session('id_sanggar');
        return Sanggar::find($session);
    }



}
