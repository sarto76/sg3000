<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Oct 2018 15:42:20 +0000.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LicenseMember
 *
 * @property int $id
 * @property int $license_id
 * @property int $member_id
 * @property \Carbon\Carbon $valid_from
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class LicenseMember extends Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

	protected $table = 'license_member';

	protected $casts = [
		'license_id' => 'int',
		'member_id' => 'int',
	];

	protected $dates = [
		'valid_from'
	];

	protected $fillable = [
		'license_id',
		'member_id',
		'valid_from'
	];

    protected $softCascade = ['lessonLicenseMember'];

    public function lessons(){
        return $this->belongsToMany(Lesson::class,'lesson_license_member','license_member_id','lesson_id')->withPivot('notes');
    }
    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
    public function lessonLicenseMember(){
        return $this->hasMany(LessonLicenseMember::class,'license_member_id','id');
    }
    public function license(){
        return $this->belongsTo(License::class,'license_id');
    }
    public function getValidFromAttribute($date){
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public function settValidFromAttribute($date) {
        $this->attributes['valid_from']= \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
}
