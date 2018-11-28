<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;

use Carbon\Carbon;
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
 * @property Carbon $birthdate
 * @property int $instructor_id
 * @property int $user_status_id
 * @property string $session
 * @property string $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
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
        return $this->belongsToMany(License::class,'license_member','member_id','license_id')
            ->whereNull('license_member.deleted_at')
            ->withPivot('valid_from');
    }

    public function licenseMember(){
        return $this->hasMany(LicenseMember::class,'member_id','id');
    }

    public function getBirthdateAttribute($date){
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function setBirthdateAttribute($date) {
        $this->attributes['birthdate']= \Carbon\Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * @param  $licenseMemberId
     * @return mixed
     */
    public function getCoursesByLicenseMember($licenseMemberId){
        return Course::select ('courses.id','courses.course_type_id','courses.facebook','licenses.description')
            ->distinct('courses.id')
            ->orderBy('courses.id','desc')
            ->join('lessons','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->join('lesson_license_member','lessons.id','lesson_license_member.lesson_id')
            ->join('license_member','license_member.id','lesson_license_member.license_member_id')
            ->join('licenses','licenses.id','license_member.license_id')
            ->whereIn('lesson_license_member.license_member_id',$licenseMemberId)
            ->where ('lesson_license_member.deleted_at',null)
            ->get();
    }

    /**
     * @param $licenseMemberId
     * @return array
     */
    public function getLessonsIdByLicenseMemberId($licenseMemberId)
    {
        $lessonsId = LessonLicenseMember::all('lesson_id', 'license_member_id')
            ->whereIn('license_member_id', $licenseMemberId)
            ->pluck('lesson_id')
            ->toArray();
        return $lessonsId;
    }





}
