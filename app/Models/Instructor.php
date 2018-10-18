<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Instructor
 * 
 * @property int $id
 * @property string $init
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property \Carbon\Carbon $birthdate
 * @property string $mobile
 * @property string $pass
 * @property string $session
 * @property int $user_status_id
 * @property string $pushover
 * @property string $label
 * @property int $rank
 * @property string $image
 *
 * @package App\Models
 */
class Instructor extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'user_status_id' => 'int',
		'rank' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $fillable = [
		'init',
		'lastname',
		'firstname',
		'email',
		'birthdate',
		'mobile',
		'pass',
		'session',
		'user_status_id',
		'pushover',
		'label',
		'rank',
		'image'
	];
}
