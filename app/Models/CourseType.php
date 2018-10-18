<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CourseType
 * 
 * @property int $id
 * @property string $description
 * @property string $long_description
 * @property int $number_lessons
 *
 * @package App\Models
 */
class CourseType extends Eloquent
{
	protected $table = 'course_type';
	public $timestamps = false;

	protected $casts = [
		'number_lessons' => 'int'
	];

	protected $fillable = [
		'description',
		'long_description',
		'number_lessons'
	];
}
