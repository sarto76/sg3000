<?php

namespace App\Http\Controllers\admin;


use App\Models\Course;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\LessonLicenseMember;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $type;



    public function getMembers()
    {
      /*  $members = DB::table('members')
            ->select(['id','nip','firstname','lastname', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate')])
            ->whereNull('deleted_at');*/

        $members = DB::table('members')
            ->select(['license_member.id as id','nip','firstname','lastname', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate'),'description'])
            ->join('license_member','members.id','license_member.member_id')
            ->join ('licenses','licenses.id','license_member.license_id')

            ->whereNull('members.deleted_at')
            ->orderBy('members.lastname','asc');


        return Datatables::of($members)
            ->addIndexColumn()
            ->addColumn('action', function ($member) {
                //return '<a href="admin/lessons/' . $id->id . '/addMember" class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>'; })->make(true);


                /*$clic='addMemberToLesson('.$member->id.','.$member->nip.',"'.$member->firstname.'","'.$member->lastname.'","'.$member->birthdate.'")';
                $link='<a onclick="'.$clic.'" class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>';
                return $link;})->make(true);*/

                $clic="addMemberToLesson($member->id,$member->nip,'$member->firstname','$member->lastname','$member->birthdate')";
                $link='<a onclick="'.$clic.'" class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>';
                return $link;})->make(true);


                /*return '<a onclick="addMemberToLesson(' . $member->id . ',' . $member->nip . ',' . $member->firstname . ',' . $member->lastname . ',' . $member->birthdate . ')"
         class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>'; })->make(true);*/

        /*return '<a onclick="addMemberToLesson(' . $member->id . ',' . $member->nip . ',' . $member->firstname . ',' . $member->lastname . ',' . $member->birthdate . ')"
         class="btn btn-info btn-xs"><i class="fa fa-arrow-up" title="Add to lesson"></i></a>'; })->make(true);*/
    }

    public function index($typ)
    {
     /*   $typ = $request->get('typ');

        if(empty($typ)){
            $typ=$request->session()->get('typ');
        }*/
        $this->type=$typ;

        //DB::enableQueryLog();


        $courses=Course::orderBy('id','desc')
            ->with('type')
            ->whereHas('type',function($q) use ($typ){
                $q->where('description','=',$typ);
            })
            ->paginate(10);

       /*      dd($list);


                echo("<pre>");
                print_r($list);
                echo("</pre>");*/

        //dd(DB::getQueryLog());
        return view('admin.lessons.lessons_show',compact('lessons','typ','courses'));
    }


    /**
     * Metodo che serve a ricercare un corso
     * @param  request $request parola da cercare
     * @return view
     */
    public function search(Request $request,$typ)
    {
        //$typ = $request->get('typ');
        $search = $request->get('search');

        $courses = Course::select ('courses.id','courses.course_type_id','courses.course_status_id','courses.facebook')
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

       /* $courses = Course::orderBy('id','desc')
            ->with('type')
            ->whereHas('type',function($q) use ($typ){
                $q->where('description','=',$typ);
            })
            ->with('lessons')
            ->whereHas('lessons',function($r) use ($search){
                $r->where('number', 'LIKE', $search.'%');
            })
            ->with('lessons.instructor')
            ->orWhereHas('lessons.instructor',function($r) use ($search){
                $r->where('lastname', 'LIKE', $search.'%')
                    ->orWhere('firstname', 'LIKE', $search.'%');
            })
            ->toSql();*/





        //dd($courses);
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


        $allLessons=range(1,$course->type->number_lessons);


        foreach($course->lessons as $lesson) {
            $occupedLessons[] = $lesson->number;
        }
        $uniqueOccupedLessons=array_unique($occupedLessons);
        $availablesLessons = array_diff($allLessons, $uniqueOccupedLessons);
        $availablesLessons=array_combine($availablesLessons,$availablesLessons);


        return view('admin.lessons.lessons_create',compact('instructors','course','availablesLessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator=Validator::make($request->all(),[
            'number'=> 'bail|required|max:10',
            'date_time'=> 'bail|required',
        ]);


        //dd($request->all());

        if($validator->fails()){
            return redirect()
                ->route('lessons.create',[$request->course_id])
                ->withInput()
                ->withErrors($validator);
        }

        $typ=Course::find($request->course_id)->type->description;

        $lesson=new Lesson();
        $lesson->course_id =$request->course_id;
        $lesson->course_status_id =$request->course_status_id;
        $lesson->instructor_id =$request->instructor;
        $lesson->number=$request->number;
        $lesson->date_time=Carbon::parse($request->date_time)->format('Y-m-d H:i:s');

        $lesson->save();

        foreach($request->all() as $key => $value) {
            if (strpos($key, 'member') === 0) {
                $lessonLicenseMember=new LessonLicenseMember();
                $lessonLicenseMember->lesson_id=$lesson->id;
                $lessonLicenseMember->license_member_id=$value;
                $lessonLicenseMember->save();
            }
        }



        return redirect()->route('lessons.index',[$typ])->with('success',trans('lesson.added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return view('admin.members.members_detail',compact('member','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson= Lesson::find($id);

        $instructors = Instructor::select(DB::raw("CONCAT(firstname,' ',lastname)as name"),'id')
            ->pluck('name', 'id');
        $course=Course::find();
        $occupedLessons=[];


        $allLessons=range(1,$course->type->number_lessons);


        foreach($course->lessons as $lesson) {
            $occupedLessons[] = $lesson->number;
        }
        $uniqueOccupedLessons=array_unique($occupedLessons);
        $availablesLessons = array_diff($allLessons, $uniqueOccupedLessons);
        $availablesLessons=array_combine($availablesLessons,$availablesLessons);




        return view('admin.lessons.members_edit',compact('lesson','id'));
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
            'title'=> 'bail|required|max:50',
            'firstname' => 'bail|required|max:100',
            'lastname'  => 'bail|required|max:100',
            'email'     => 'bail|required|email',
            'address'=> 'bail|required|max:100',
            'zip'=> 'bail|required|numeric|min:1000|max:9999',
            'city'=> 'required|max:100',
            'phone'=> 'max:100',
            'mobile'=> 'bail|required|max:100',
            'work'=> 'max:100',
            'birthdate'=> 'bail|required|date',

        ]);


        if($validator->fails()){
            return redirect("members/' . $id->id . '/edit")
                ->withInput()
                ->withErrors($validator);
        }
        else{
            $member = Member::find($id);
            $member->title =$request->title;
            $member->firstname=$request->firstname;
            $member->lastname=$request->lastname;
            $member->email=$request->email;
            $member->address=$request->address;
            $member->zip=$request->zip;
            $member->city=$request->city;
            $member->phone=$request->phone;
            $member->mobile=$request->mobile;
            $member->work=$request->work;
            $member->birthdate=Carbon::parse($request->birthdate)->format('Y-m-d');

            $member->save();
            return redirect()->route('members.index')->with('success',trans('member.updated'));
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
        $this->type=$lesson->course->type->description;
        $course_id=$lesson->course_id;
        $lesson->delete();
        $course=Course::find($course_id);
        $typ=$course->type->description;

        if(!Lesson::where('course_id', '=', $course_id)->first()){
            $course->delete();
        }

        if($actualMembers=LessonLicenseMember::where('lesson_id','=',$id)->get()){
            foreach ($actualMembers as $actualMember) {
                $actualMember->delete();
            }
        }


        return redirect()->route('lessons.index',[$typ])->with('success',trans('lesson.deleted'))->with('typ',$this->type);
    }
}
