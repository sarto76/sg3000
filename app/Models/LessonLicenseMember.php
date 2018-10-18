<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:28 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LessonLicenseMember
 * 
 * @property int $id
 * @property int $lesson_id
 * @property string $notes
 * @property int $license_member_id
 *
 * @package App\Models
 */
class LessonLicenseMember extends Eloquent
{
	protected $table = 'lesson_license_member';
	public $timestamps = false;

	protected $casts = [
		'lesson_id' => 'int',
		'license_member_id' => 'int'
	];

	protected $fillable = [
		'lesson_id',
		'notes',
		'license_member_id'
	];
}
