<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 * 
 * @property int $id
 * @property int $course_id
 * @property \Carbon\Carbon $date_time
 * @property int $number
 * @property int $instructor_id
 * @property int $status_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Lesson extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'course_id' => 'int',
		'number' => 'int',
		'instructor_id' => 'int',
		'status_id' => 'int'
	];

	protected $dates = [
		'date_time'
	];

	protected $fillable = [
		'course_id',
		'date_time',
		'number',
		'instructor_id',
		'status_id'
	];

    public function LicenseMember(){
        return $this->belongsToMany(LicenseMember::class,'lesson_license_member','license_member_id','lesson_id')->withPivot('notes');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }
    public function courseType(){

    }
    public function instructor(){
        return $this->belongsTo(Instructor::class,'instructor_id');
    }
    public function LessonLicenseMember(){
        return $this->hasMany(LessonLicenseMember::class);
    }
}
