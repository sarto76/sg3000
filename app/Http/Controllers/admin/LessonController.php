<?php

namespace App\Http\Controllers\admin;


use App\Models\Course;
use App\Models\LicenseMember;
use App\Models\Member;
use App\Models\Status;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\LessonLicenseMember;
use Carbon\Carbon;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Yajra\DataTables\DataTables;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getMembers()
    {

        $members = DB::table('members')
            ->select(['license_member.id as id','nip','firstname','lastname', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate'),'description'])
            ->join('license_member','members.id','license_member.member_id')
            ->join ('licenses','licenses.id','license_member.license_id')

            ->whereNull('members.deleted_at')
            ->orderBy('members.lastname','asc');


        return Datatables::of($members)
            ->addIndexColumn()
            ->addColumn('action', function ($member) {

                $clic="addMemberToLesson($member->id,$member->nip,'$member->firstname','$member->lastname','$member->birthdate')";
                $link='<a onclick="'.$clic.'" class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>';
                return $link;})->make(true);
    }

    public function getMembersDirect()
    {
        $members = DB::table('members')
            ->select(['license_member.id as id','nip','firstname','lastname', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate'),'description'])
            ->join('license_member','members.id','license_member.member_id')
            ->join ('licenses','licenses.id','license_member.license_id')

            ->whereNull('members.deleted_at')
            ->orderBy('members.lastname','asc');


        return Datatables::of($members)
            ->addIndexColumn()
            ->addColumn('action', function ($member) {


                $clic="addMemberToLessonDirect($member->id)";
                $link='<a onclick="'.$clic.'" class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>';
                return $link;})->make(true);

    }

    public function addMember(Request $request)
    {
        $lessonLicenseMember=new LessonLicenseMember();


        $lessonId = $request->session()->get('lessonId',1);
        $maxMembers=Lesson::find($lessonId)->course->type->max_members;

        $actualMembers=$lessonLicenseMember::where('lesson_id','=',$lessonId)->count();


        if((!($lessonLicenseMember::where('lesson_id','=',$lessonId)
            ->where('license_member_id','=',$request->licenseMemberId)
            ->exists())) && $actualMembers<$maxMembers) {

            $lessonLicenseMember->lesson_id = $lessonId;
            $lessonLicenseMember->license_member_id = $request->licenseMemberId;
            $lessonLicenseMember->save();

            $member=LicenseMember::find($request->licenseMemberId)->member;
            return response()->json([ 'user_saved' => $member ,'llm'=>$lessonLicenseMember,'actualMembers'=>$actualMembers]);

        }
        else{
            return null;
        }

    }


    public function index($typ)
    {

        $courses = Course::select ('courses.id','courses.course_type_id','courses.facebook')
            ->orderBy('courses.id','desc')
            ->leftJoin('lessons','lessons.course_id','courses.id')
            ->leftJoin('course_type','courses.course_type_id','course_type.id')
            ->where('course_type.description','=', $typ)
            ->paginate(10);

        return view('admin.lessons.lessons_show',compact('lessons','typ','courses'));
    }


    /**
     * Metodo che serve a ricercare un corso
     * @param  request $request parola da cercare
     * @return view
     */
    public function search(Request $request,$typ)
    {
        $search = $request->get('search');

        $courses = Course::select ('courses.id','courses.course_type_id','courses.facebook')
            ->distinct()
            ->orderBy('courses.id','desc')
            ->join('lessons','lessons.course_id','courses.id')
            ->join('instructors','lessons.instructor_id','instructors.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->where('course_type.description','LIKE', $typ)
            ->where(function($query) use ($search){
                $query->where('date_time', 'LIKE', '%'.$search . '%')
                    ->orWhere('number', 'LIKE', $search . '%')
                    ->orWhere('lastname', 'LIKE', $search . '%')
                    ->orWhere('firstname', 'LIKE', $search . '%');
            })
            ->paginate(10);

        $courses->appends(['search' => $search]);
        return view('admin.lessons.lessons_show', compact('courses','typ','lessons'))->with($search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create($courseId)
    {
        $instructors = Instructor::select(DB::raw("CONCAT(firstname,' ',lastname)as name"),'id')
        ->pluck('name', 'id');
        $course=Course::find($courseId);
        $occupedLessons=[];

        $status = Status::pluck('description', 'id');


        $allLessons=range(1,$course->type->number_lessons);


        foreach($course->lessons as $lesson) {
            $occupedLessons[] = $lesson->number;
        }
        $uniqueOccupedLessons=array_unique($occupedLessons);
        $availablesLessons = array_diff($allLessons, $uniqueOccupedLessons);
        $availablesLessons=array_combine($availablesLessons,$availablesLessons);


        return view('admin.lessons.lessons_create',compact('instructors','course','availablesLessons','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'number'=> 'bail|required|max:10',
            'date_time'=> 'bail|required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('lessons.create',[$request->course_id])
                ->withInput()
                ->withErrors($validator);
        }

        $course=Course::find($request->course_id);
        $typ=$course->type->description;
        $previousLessonsInCourse=$course->lessons;

        $idActualLesson = Lesson::create($request->all())->id;

        if(isset($request->member)) {
            foreach ($request->member as $licenseMemberId) {

                $this->createLessonLicenseMember($request, $idActualLesson, $licenseMemberId);

                //if one of the members should go in the others lesson of the course
                if (isset($request->memberAllLesson)) {
                    //if this member should go in the others lesson of the course
                    if (in_array($licenseMemberId, $request->memberAllLesson)) {
                        foreach ($previousLessonsInCourse as $less) {

                            //control if there is allready the same member
                            $llm = LessonLicenseMember::where('license_member_id', $licenseMemberId)
                                ->where('lesson_id', $less->id)
                                ->get();

                            if ($llm->isEmpty()) {
                                $this->createLessonLicenseMemberWithoutNotes($less, $licenseMemberId);
                            }
                        }
                    }
                }
            }
        }
        $course->fresh();
        return $this->warningRedirectMessageIfTooManyMembersInLesson($course, $typ);
    }


    /**
     * @param $course
     * @param $typ
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function warningRedirectMessageIfTooManyMembersInLesson($course, $typ): \Illuminate\Http\RedirectResponse
    {
        $redirectWithWarning=false;
        foreach ($course->lessons as $less) {

            $inscriptions = $less->LessonLicenseMember;
            if (count($inscriptions) > $course->type->max_members) {
                $redirectWithWarning = true;
                break;
            }
        }

        if ($redirectWithWarning === true) {
            return redirect()->route('lessons.index', [$typ.'#'.$course->id])->with('warning', trans('lesson.added_but_too_many_members'));
        } else {
            return redirect()->route('lessons.index', [$typ.'#'.$course->id])->with('success', trans('lesson.added'));
        }
    }

    /**
     * @param Request $request
     * @param $idActualLesson
     * @param $licenseMemberId
     */
    protected function createLessonLicenseMember(Request $request, $idActualLesson, $licenseMemberId): void
    {
        $lessonLicenseMember = new LessonLicenseMember();
        $lessonLicenseMember->lesson_id = $idActualLesson;
        $lessonLicenseMember->license_member_id = $licenseMemberId;

        //if this member has notes
        if (array_key_exists('notes' . $licenseMemberId, $request->all())) {
            $lessonLicenseMember->notes = $request->all()['notes' . $licenseMemberId];
        }
        $lessonLicenseMember->save();
    }

    /**
     * @param $less
     * @param $licenseMemberId
     */
    protected function createLessonLicenseMemberWithoutNotes($less, $licenseMemberId): void
    {
        $lessonLicenseMember = new LessonLicenseMember();
        $lessonLicenseMember->lesson_id = $less->id;
        $lessonLicenseMember->license_member_id = $licenseMemberId;
        $lessonLicenseMember->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        return view('admin.lessons.lessons_detail',compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        session(['lessonId' => $id]);
        $lesson= Lesson::find($id);

        $instructors = Instructor::select(DB::raw("CONCAT(firstname,' ',lastname)as name"),'id')
            ->pluck('name', 'id');
        $course=Course::find($lesson->course->id);
        $status=Status::pluck('description','id');
        $occupedLessons=[];


        $allLessons=range(1,$course->type->number_lessons);
        foreach($course->lessons as $less) {
            //dd($less->id);
            if($less->id != $lesson->id) {
                $occupedLessons[$less->id] = $less->number;
            }
        }

        $uniqueOccupedLessons=array_unique($occupedLessons);
        $availablesLessons = array_diff($allLessons, $uniqueOccupedLessons);
        $availablesLessons=array_combine($availablesLessons,$availablesLessons);
        return view('admin.lessons.lessons_edit',compact('lesson','id','instructors', 'status','availablesLessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            'number'=> 'bail|required|max:10',
            'date_time'=> 'bail|required',
        ]);

        if($validator->fails()){
            return redirect("lessons/' . $id->id . '/edit")
                ->withInput()
                ->withErrors($validator);
        }
        else{
            $lesson = Lesson::findOrFail($id);
            $lesson->fill($request->all())->save();
            return redirect()->route('lessons.edit',['lesson'=>$lesson->id])->with('id',trans('lesson.updated'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson=Lesson::findOrFail($id);
        $course_id=$lesson->course_id;
        $lesson->delete();
        $course=Course::find($course_id);

       /* //delete course if it has no lessons
        if(!Lesson::where('course_id', '=', $course_id)->first()){
            $course->delete();
        }*/

        return redirect()->route('lessons.index',[$course->type->description.'#'.$course->id])->with('success',trans('lesson.deleted'))->with('typ',$lesson->course->type->description);
    }

    public function removeMember($lessonLicenseMemberId)
    {
        $lessonLicenseMember=LessonLicenseMember::findOrFail($lessonLicenseMemberId);
        $lesson=$lessonLicenseMember->lesson;
        $lessonLicenseMember->delete();
        return redirect()->route('lessons.edit',['lesson'=>$lesson->id])->with('id',trans('lesson.member_removed'))->withInput(['tab'=>'tab2']);
    }

    public function editLessonLicenseMember(Request $request)
    {

        $lessonLicenseMember=LessonLicenseMember::findOrFail($request->lessonLicenseMemberId);
        $lessonLicenseMember->notes=$request->notes;
        $lessonLicenseMember->save();

        //return redirect()->route('lessons.edit',['lesson'=>$lesson->id])->with('id',trans('lesson.member_removed'))->withInput(['tab'=>'tab2']);
    }


}


