<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructor
 * 
 * @property int $id
 * @property string $init
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property \Carbon\Carbon $birthdate
 * @property string $mobile
 * @property string $password
 * @property string $session
 * @property int $user_status_id
 * @property string $pushover
 * @property string $label
 * @property int $rank
 * @property string $image
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Instructor extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'user_status_id' => 'int',
		'rank' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'init',
		'firstname',
		'lastname',
		'email',
		'birthdate',
		'mobile',
		'password',
		'session',
		'user_status_id',
		'pushover',
		'label',
		'rank',
		'image'
	];

    public function user_status(){
        return $this->belongsTo(UserStatus::class);
    }
    public function membersMessage(){
        return $this->belongsToMany(Member::class,'messages','instructor_id','member_id')->withPivot(['title','text']);
    }


    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

}
