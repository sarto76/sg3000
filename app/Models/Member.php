<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Member
 * 
 * @property int $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property int $title
 * @property string $address
 * @property string $zip
 * @property string $city
 * @property string $phone
 * @property string $mobile
 * @property string $work
 * @property \Carbon\Carbon $birthdate
 * @property int $instructor_id
 * @property int $user_status_id
 * @property string $session
 *
 * @package App\Models
 */
class Member extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'title' => 'int',
		'instructor_id' => 'int',
		'user_status_id' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $fillable = [
		'email',
		'firstname',
		'lastname',
		'title',
		'address',
		'zip',
		'city',
		'phone',
		'mobile',
		'work',
		'birthdate',
		'instructor_id',
		'user_status_id',
		'session'
	];
}
