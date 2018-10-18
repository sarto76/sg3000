<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class License
 * 
 * @property int $id
 * @property int $license_type_id
 * @property string $text
 *
 * @package App\Models
 */
class License extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'license_type_id' => 'int'
	];

	protected $fillable = [
		'license_type_id',
		'text'
	];
}
