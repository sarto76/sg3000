<?php
namespace App\Http\Controllers\Traits;
use App\Models\LessonLicenseMember;

trait InscriptionTraitController {

    public function removeMemberByLessonLicenseMemberId($lessonLicenseMemberId)
    {
        $lessonLicenseMember=LessonLicenseMember::findOrFail($lessonLicenseMemberId);
        $lesson=$lessonLicenseMember->lesson;
        $lessonLicenseMember->delete();
    }
}