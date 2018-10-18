<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Payment
 * 
 * @property int $id
 * @property \Carbon\Carbon $date
 * @property int $member_id
 * @property int $course_id
 * @property int $instructor_id
 * @property float $amount
 *
 * @package App\Models
 */
class Payment extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'member_id' => 'int',
		'course_id' => 'int',
		'instructor_id' => 'int',
		'amount' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'date',
		'member_id',
		'course_id',
		'instructor_id',
		'amount'
	];
}
