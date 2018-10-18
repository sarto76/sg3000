<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Setting
 * 
 * @property int $id
 * @property string $key
 * @property string $value
 *
 * @package App\Models
 */
class Setting extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'key',
		'value'
	];
}
