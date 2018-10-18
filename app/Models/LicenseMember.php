<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 13:27:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LicenseMember
 * 
 * @property int $id
 * @property int $license_id
 * @property int $member_id
 * @property string $nip
 * @property string $ts
 *
 * @package App\Models
 */
class LicenseMember extends Eloquent
{
	protected $table = 'license_member';
	public $timestamps = false;

	protected $casts = [
		'license_id' => 'int',
		'member_id' => 'int'
	];

	protected $fillable = [
		'license_id',
		'member_id',
		'nip',
		'ts'
	];
}
