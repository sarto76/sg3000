<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Course
 * 
 * @property int $id
 * @property int $course_type_id
 * @property int $course_status_id
 * @property string $facebook
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Course extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'course_type_id' => 'int',
		'course_status_id' => 'int'
	];

	protected $fillable = [
		'course_type_id',
		'course_status_id',
		'facebook'
	];


    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function status(){
        return $this->belongsTo(CourseStatus::class);
    }
    public function type(){
        return $this->belongsTo(CourseType::class);
    }


}
