<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
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
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CourseType extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'course_type';

	protected $casts = [
		'number_lessons' => 'int'
	];

	protected $fillable = [
		'description',
		'long_description',
		'number_lessons'
	];
}
