<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Message
 * 
 * @property int $id
 * @property int $type
 * @property int $member_id
 * @property int $instructor_id
 * @property string $text
 *
 * @package App\Models
 */
class Message extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'type' => 'int',
		'member_id' => 'int',
		'instructor_id' => 'int'
	];

	protected $fillable = [
		'type',
		'member_id',
		'instructor_id',
		'text'
	];
}
