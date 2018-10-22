<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $casts = [
        'course_id' => 'int',
        'instructor_id' => 'int',
        'member_id' => 'int'
    ];



    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }
    public function member(){
        return $this->belongsTo(Member::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }


}
