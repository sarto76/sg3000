<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserStatus
 * 
 * @property int $id
 * @property string $description
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class UserStatus extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $table = 'user_status';

	protected $fillable = [
		'description'
	];

    public function member(){
        return $this->hasMany(Member::class);
    }

    public function instructors(){
        return $this->hasMany(Instructor::class);
    }


}

