<?php
namespace App\Http\Controllers\Traits;
use App\Models\Course;
use App\Models\LessonLicenseMember;

trait InscriptionTraitController {

    public function removeMemberByLessonLicenseMemberId($lessonLicenseMemberId)
    {
        $lessonLicenseMember=LessonLicenseMember::findOrFail($lessonLicenseMemberId);
        $lesson=$lessonLicenseMember->lesson;
        $lessonLicenseMember->delete();
    }

    public function getLessonsInCourses()
    {
        $lessons = Course::select ('courses.id as id','description as description'
            ,'lessons.number as number','lessons.date_time as date_time')
            ->orderBy('id','desc')
            ->orderBy('lessons.id','esc')
            ->join('lessons','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->get();
        return $lessons;
    }
}