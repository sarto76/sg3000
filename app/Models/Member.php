<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Member
 * 
 * @property int $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $title
 * @property string $address
 * @property int $zip
 * @property string $city
 * @property string $phone
 * @property string $mobile
 * @property string $work
 * @property \Carbon\Carbon $birthdate
 * @property int $instructor_id
 * @property int $user_status_id
 * @property string $session
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Member extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;


	protected $casts = [
		'zip' => 'int',
		'instructor_id' => 'int',
		'user_status_id' => 'int'
	];

	protected $dates = [
		'birthdate'
	];

	protected $fillable = [
		'email',
		'firstname',
		'lastname',
		'title',
		'address',
		'zip',
		'city',
		'phone',
		'mobile',
		'work',
		'birthdate',
		'instructor_id',
		'user_status_id',
		'session'
	];

    protected $softCascade = ['licenseMember'];

	public function userStatus(){
	    return $this->belongsTo(UserStatus::class);
    }

    public function instructorsMessage(){
        return $this->belongsToMany(Instructor::class,'messages','instructor_id','member_id')->withPivot(['title','text']);
    }


    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function licenses(){
        return $this->belongsToMany(License::class,'license_member','member_id','license_id')->withPivot('valid_from');
    }

    public function licenseMember(){
        return $this->hasMany(LicenseMember::class,'member_id','id');
    }




}
