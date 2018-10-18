<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserStatus
 * 
 * @property int $id
 * @property string $description
 *
 * @package App\Models
 */
class UserStatus extends Eloquent
{
	protected $table = 'user_status';
	public $timestamps = false;

	protected $fillable = [
		'description'
	];
}
