<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class License
 *
 * @property int $id
 * @property int $license_type_id
 * @property string $text
 * @property int $nip
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string description
 *
 * @package App\Models
 */
class License extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'license_type_id' => 'int',
        'nip' => 'int'
	];

	protected $fillable = [
		'license_type_id',
		'text',
        'nip'
	];


    public function members(){
        return $this->belongsToMany(Member::class,'license_member','license_id','member_id')->withPivot('valid_from');
    }

}
