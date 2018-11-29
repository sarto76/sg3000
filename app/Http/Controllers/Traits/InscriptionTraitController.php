<?php
namespace App\Http\Controllers\Traits;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonLicenseMember;

trait InscriptionTraitController {

    public function removeMemberByLessonLicenseMemberId($lessonLicenseMemberId)
    {
        $lessonLicenseMember=LessonLicenseMember::findOrFail($lessonLicenseMemberId);
        $lesson=$lessonLicenseMember->lesson;
        $lessonLicenseMember->delete();
    }

    public function getOpenLessonsInCourses($licenseMemberId)
    {
        /*$lessons =Lesson::select ('lessons.id as idLesson','courses.id as id','course_type.description as description'
            ,'lessons.number as number','lessons.date_time as date_time')
            ->status('aperto')
            ->concluded(false)
            ->join('courses','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->get();
        return $lessons;*/

        $openLessons = Lesson::all()->filter(function ($lesson, $key) {
            return !$lesson->isFull();
        });

        $lessons = Lesson::whereIn('lessons.id', $openLessons->pluck('id')->all())
            ->select ('lessons.id as idLesson','courses.id as id','course_type.description as description'
                ,'lessons.number as number','lessons.date_time as date_time')
            ->status('aperto')
            ->concluded(false)
            ->join('courses','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->get();
        return $lessons;
    }
}