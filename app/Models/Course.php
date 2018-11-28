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
 * @property string $facebook
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 * @method static find($course_id)
 * @method static findOrFail(int $id)
 */
class Course extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

	protected $casts = [
		'course_type_id' => 'int',
	];

	protected $fillable = [
		'course_type_id',
		'facebook'
	];

    protected $softCascade = ['lessons'];

    public function payments(){
        return $this->hasMany(Payment::class,'course_id','id');
    }

    public function lessons(){
        return $this->hasMany(Lesson::class,'course_id','id');
    }

    public function type(){
        return $this->belongsTo(CourseType::class,'course_type_id');
    }
    public function firstLesson(){
        return $this->hasOne(Lesson::class,'course_id','id')
                ->selectRaw('course_id, min(date_time) as first_lesson')
                ->groupBy('course_id');

    }
    public function getFirstLesson(){
        if ( ! array_key_exists('firstLesson', $this->relations)) $this->load('firstLesson');

        $related = $this->getRelation('firstLesson');

        return ($related) ? $related->first_lesson : null;

    }



}
