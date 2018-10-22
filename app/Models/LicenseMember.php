<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LicenseMember
 * 
 * @property int $id
 * @property int $license_id
 * @property int $member_id
 * @property int $nip
 * @property \Carbon\Carbon $valid_from
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class LicenseMember extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'license_member';

	protected $casts = [
		'license_id' => 'int',
		'member_id' => 'int',
		'nip' => 'int'
	];

	protected $dates = [
		'valid_from'
	];

	protected $fillable = [
		'license_id',
		'member_id',
		'nip',
		'valid_from'
	];
}
