<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use stdClass;

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
        'email',
        'password',
        'nomor_telepon',
        'user_profile',
        'role',
        'json_token_lupa_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Krama()
    {
        return $this->hasOne(Krama::class, 'id_user', 'id');
    }

    public function Penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'id_penduduk', 'id');
    }

    public function Sanggar()
    {
        return $this->hasOne(Sanggar::class, 'id_user', 'id');
    }

    public function Sulinggih()
    {
        return $this->hasOne(Sulinggih::class, 'id_user', 'id');
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
}
