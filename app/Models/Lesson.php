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
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

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

    protected $softCascade = ['lessonLicenseMember'];

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


    public function getDateTimeAttribute($date){
        return \Carbon\Carbon::parse($date)->format('d-m-Y G:i');
    }

    public function setDateTimeAttribute($date) {
        $this->attributes['date_time']= \Carbon\Carbon::parse($date)->format('Y-m-d G:i:s');
    }

    public function getLessonLicenseMemberIdByLicenseMemberId($licenseMemberId){
        //dd($this->LessonLicenseMember()->distinct()->where('license_member_id',$licenseMemberId)->get());
        return $this->LessonLicenseMember()->distinct()->where('license_member_id',$licenseMemberId)->first()->id;
    }
    public function scopeStatus($query, $value)
    {
        return $query
            ->where('status.description', $value)
            ->join('status','lessons.status_id','status.id')
            ;
    }

    public function scopeConcluded($query, $flag=true)
    {
        if($flag){
            return $query
                ->where('date_time','<' ,now());
        }
        else{
            return $query
                ->where('date_time','>' ,now());
        }
    }

    public function isFull(){
        $maxMembers=$this->course->type->max_members;
        $countActualMembers=LessonLicenseMember::where('lesson_id',$this->id)->count();
        if( $countActualMembers < $maxMembers) {
            return false;
        }
        else{
            return true;
        }
    }
}
