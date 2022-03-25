<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use ReflectionFunctionAbstract;

/**
 * Class Notification
 *
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property Carbon|null $read_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notifications';
	public $incrementing = false;

	protected $casts = [
		'notifiable_id' => 'int'
	];

	protected $dates = [
		'read_at',
		'created_at',
		'updated_at'
	];

	protected $fillable = [
		'type',
		'notifiable_type',
		'notifiable_id',
		'data',
		'read_at'
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

	public function getCreatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}

	public function getUpdatedAtAttribute($date)
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}

    public function parseDataToArray()
    {
        $array = json_decode($this->data);
        return $array;
    }



}
