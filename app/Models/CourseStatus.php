<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CourseStatus
 * 
 * @property int $id
 * @property string $desctiption
 *
 * @package App\Models
 */
class CourseStatus extends Eloquent
{
	protected $table = 'course_status';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'desctiption'
	];
}
