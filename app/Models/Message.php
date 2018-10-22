<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * 
 * @property int $id
 * @property string $title
 * @property int $member_id
 * @property int $instructor_id
 * @property string $text
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Message extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'member_id' => 'int',
		'instructor_id' => 'int'
	];

	protected $fillable = [
		'title',
		'member_id',
		'instructor_id',
		'text'
	];



}
