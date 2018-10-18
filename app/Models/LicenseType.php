<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LicenseType
 * 
 * @property int $id
 * @property string $description
 * @property string $long_description
 * @property int $month_duration
 *
 * @package App\Models
 */
class LicenseType extends Eloquent
{
	protected $table = 'license_type';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'month_duration' => 'int'
	];

	protected $fillable = [
		'description',
		'long_description',
		'month_duration'
	];
}
