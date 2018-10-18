<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Course
 * 
 * @property int $id
 * @property int $course_type_id
 * @property int $course_status_id
 * @property string $facebook
 *
 * @package App\Models
 */
class Course extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'course_type_id' => 'int',
		'course_status_id' => 'int'
	];

	protected $fillable = [
		'course_type_id',
		'course_status_id',
		'facebook'
	];
}
