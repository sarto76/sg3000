<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonLicenseMember
 * 
 * @property int $id
 * @property int $lesson_id
 * @property string $notes
 * @property int $license_member_id
 * @property \Carbon\Carbon $valid_from
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class LessonLicenseMember extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'lesson_license_member';

	protected $casts = [
		'lesson_id' => 'int',
		'license_member_id' => 'int'
	];

	protected $dates = [
		'valid_from'
	];

	protected $fillable = [
		'lesson_id',
		'notes',
		'license_member_id',
		'valid_from'
	];
}
