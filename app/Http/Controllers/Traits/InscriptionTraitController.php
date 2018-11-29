<?php
namespace App\Http\Controllers\Traits;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonLicenseMember;
use Illuminate\Session\Store;

trait InscriptionTraitController {

    public function removeMemberByLessonLicenseMemberId($lessonLicenseMemberId)
    {
        $lessonLicenseMember=LessonLicenseMember::findOrFail($lessonLicenseMemberId);
        $lesson=$lessonLicenseMember->lesson;
        $lessonLicenseMember->delete();
    }

    public function getOpenLessonsInCourses(Store $request)
    {
        $inscriptionsIdList=LessonLicenseMember::where('license_member_id',$request->get('licenseMemberId'))->pluck('lesson_id')->toArray();


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
            ->whereNotIn('lessons.id',$inscriptionsIdList)
            ->get();
        return $lessons;


    /*    $lessons =Lesson::select ('lessons.id as idLesson','courses.id as id','course_type.description as description'
            ,'lessons.number as number','lessons.date_time as date_time')
            ->status('aperto')
            ->concluded(false)
            ->join('courses','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->whereNotIn('lessons.id',$inscriptionsIdList)
            ->get();
        return $lessons;*/


    }
}