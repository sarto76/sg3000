<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LicenseType
 * 
 * @property int $id
 * @property string $description
 * @property string $long_description
 * @property int $month_duration
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class LicenseType extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'license_type';

	protected $casts = [
		'month_duration' => 'int'
	];

	protected $fillable = [
		'description',
		'long_description',
		'month_duration'
	];

	public function licenses()
    {
        $this->hasMany(License::class);
    }
}
