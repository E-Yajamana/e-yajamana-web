<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSanggar
 *
 * @property int $id
 * @property int|null $id_banjar_dinas
 * @property string|null $nama_sanggar
 * @property string|null $alamat_sanggar
 * @property string|null $sk_tanda_usaha
 * @property float|null $lat
 * @property float|null $lng
 * @property string|null $status_konfirmasi_akun
 * @property string|null $keterangan_konfirmasi_akun
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|TbKepemilikanSanggar[] $tb_kepemilikan_sanggars
 *
 * @package App\Models
 */
class Sanggar extends Model
{
	protected $table = 'tb_sanggar';

	protected $casts = [
		'id_desa' => 'int',
		'lat' => 'float',
		'lng' => 'float'
	];

	protected $fillable = [
		'id_desa_dinas',
		'nama_sanggar',
		'alamat_sanggar',
		'sk_tanda_usaha',
		'profile',
		'lat',
		'lng',
		'status_konfirmasi_akun',
		'keterangan_konfirmasi_akun'
	];

    public function User()
    {
        return $this->belongsToMany(User::class,'tb_kepemilikan_sanggar','id_sanggar','id_user')->withTimestamps();
    }

    public function Reservasi()
	{
		return $this->hasMany(Reservasi::class, 'id_sanggar','id');
	}

    public function FavoritUser()
	{
		return $this->belongsToMany(User::class, 'tb_favorit', 'id_sanggar', 'id_user');
	}

    public function BanjarDinas()
	{
		return $this->belongsTo(BanjarDinas::class, 'id_banjar_dinas','id');
	}

}
