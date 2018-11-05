<?php

namespace App\Http\Controllers\admin;


use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typ = $request->get('typ');
//dd($typ);
        //$lessons=Lesson::orderBy('number', 'asc')->paginate(10);
        //DB::enableQueryLog();
        $lessons=DB::table('lessons')
                        ->select('lessons.id as id','courses.id as course','lessons.date_time as date_time','lessons.number as number','course_status.description as status','course_type.description as type')
                        ->join('courses','lessons.course_id','courses.id')
                        ->join('course_status','lessons.course_status_id','course_status.id')
                        ->join('course_type','courses.course_type_id','course_type.id')
                        ->where('course_type.description',$typ)
                        ->orderBy('courses.id','desc')
                        ->orderBy('number')
                        ->paginate(10);

        //dd(DB::getQueryLog());
        return view('admin.lessons.lessons_show',compact('lessons','typ'));
    }


    /**
     * Metodo che serve a ricercare un magazzino
     * @param  request $request parola da cercare
     * @return view
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        $members = Member::where('email', 'LIKE', $search.'%')
            ->orWhere('firstname', 'LIKE', $search.'%')
            ->orWhere('lastname', 'LIKE', $search.'%')
            ->orWhere('address', 'LIKE', $search.'%')
            ->orWhere('zip', 'LIKE', $search.'%')
            ->orWhere('city', 'LIKE', $search.'%')
            ->orWhere('phone', 'LIKE', $search.'%')
            ->orWhere('mobile', 'LIKE', $search.'%')
            ->orWhere('work', 'LIKE', $search.'%')
            ->orWhere('birthdate', 'LIKE', $search.'%')->paginate(10);
        $members->appends(['search' => $search]);
        return view('admin.members.members_show', compact('members'))->with($search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('admin.members.members_create');
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
            return redirect()
                ->route('members.create')
                ->withInput()
                ->withErrors($validator);
        }
        $member=new Member();

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
        //return redirect()->route('members.index')->with('success','Member Added');
        return redirect()->route('members.index')->with('success',trans('member.added'));
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
        $member = Member::find($id);
        return view('admin.members.members_edit',compact('member','id'));
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
        Member::findOrFail($id)->delete();
        return redirect()->route('members.index')->with('success',trans('member.deleted'));
    }
}
