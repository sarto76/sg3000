<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Lesson
 * 
 * @property int $id
 * @property int $course_id
 * @property \Carbon\Carbon $ts
 * @property int $number
 * @property int $instructor_id
 * @property int $course_status_id
 *
 * @package App\Models
 */
class Lesson extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'course_id' => 'int',
		'number' => 'int',
		'instructor_id' => 'int',
		'course_status_id' => 'int'
	];

	protected $dates = [
		'ts'
	];

	protected $fillable = [
		'course_id',
		'ts',
		'number',
		'instructor_id',
		'course_status_id'
	];
}
