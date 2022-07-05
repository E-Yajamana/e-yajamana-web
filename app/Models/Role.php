<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbRole
 *
 * @property int $id
 * @property string|null $nama_role
 *
 * @property Collection|TbUserRole[] $tb_user_roles
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'tb_role';

	protected $fillable = [
		'nama_role'
	];

    public function User()
    {
        return $this->belongsToMany(User::class,'tb_user_roles','id_role','id_user')->withTimestamps();
    }

}
