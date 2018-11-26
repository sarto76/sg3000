<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\LessonLicenseMember;
use App\Models\License;
use App\Models\LicenseMember;
use App\Models\Member;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class MemberController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('admin.members.members_index');

        //return Datatables::of(Member::select('email','firstname','lastname','address','zip','city','phone','mobile','work','birthdate'))->make(true);
        $members=Member::orderBy('lastname', 'asc')->paginate(10);
        //print_r($members);

        return view('admin.members.members_show',compact('members'));
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
        Member::create($request->all());
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
        $licenseMember=$member->licenseMember;
        $licenseMemberId=[];
        foreach ($licenseMember as $license){
            $licenseMemberId[]=$license->id;
        }

        $courses = Course::select ('courses.id','courses.course_type_id','courses.facebook','licenses.description')
            ->distinct('courses.id')
            ->orderBy('courses.id','desc')
            ->join('lessons','lessons.course_id','courses.id')
            ->join('course_type','courses.course_type_id','course_type.id')
            ->join('lesson_license_member','lessons.id','lesson_license_member.lesson_id')
            ->join('license_member','license_member.id','lesson_license_member.license_member_id')
            ->join('licenses','licenses.id','license_member.license_id')
            ->whereIn('lesson_license_member.license_member_id',$licenseMemberId)
            ->paginate(10);

        $lessonsId=LessonLicenseMember::all('lesson_id','license_member_id')
            ->whereIn('license_member_id',$licenseMemberId)
            ->pluck('lesson_id')
            ->toArray();

        return view('admin.members.members_detail',compact('member','id','licenseMember','courses','lessonsId'));
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
        return view('admin.members.members_edit',compact('member'));
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
            return redirect("/admin/members/$id/edit")
                ->withInput()
                ->withErrors($validator);
        }
        else{
            $member = Member::findOrFail($id);
            $member->fill($request->all())->save();
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

    public function addLicense($memberId){

        $actualLicensesId=[];
        foreach ( Member::find($memberId)->licenseMember as $item) {
            $actualLicensesId[]=$item->license_id;
        }
        //dd($actualLicensesId);
        $licenses = License::select(DB::raw("CONCAT(description,' (',long_description,')')as license"),'id')
              ->whereNotIn('id', $actualLicensesId)
              ->pluck('license', 'id');
        return view('admin.members.members_add_license',compact('licenses','memberId'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeLicense(Request $request){

        //dd($request->all());
        $memberId=$request->memberId;
        $validator=Validator::make($request->all(),[
            'license'=> 'bail|required',
            'valid_from'=> 'bail|required|date',
        ]);

        if($validator->fails()){
                return redirect("/admin/members/addLicense/$memberId")
                ->withInput()
                ->withErrors($validator);
        }

       $member=Member::find($request->memberId);
        $member->licenses()->attach($request->license,['valid_from' =>  Carbon::parse($request->valid_from)->format('Y-m-d')]);
        return redirect()->route('members.edit',['member'=>$member->id])->with('success',trans('license.added'))->withInput(['tab'=>'tab2']);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateLicense(Request $request){

        //dd($request->all());
        $licenseMember=LicenseMember::find($request->licenseMemberId);

        $validator=Validator::make($request->all(),[
            'license'=> 'bail|required',
            'valid_from'=> 'bail|required|date',
        ]);

        if($validator->fails()){
            return redirect("/admin/members/addLicense/$licenseMember->member_id")
                ->withInput()
                ->withErrors($validator);
        }

        $licenseMember->valid_from=Carbon::parse($request->valid_from)->format('Y-m-d');
        $licenseMember->license_id=$request->license;
        $licenseMember->save();

        return redirect()->route('members.edit',['member'=>$licenseMember->member_id])->with('success',trans('license.added'))->withInput(['tab'=>'tab2']);

    }

    /**
     * @param $licenseMemberId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeLicense($licenseMemberId)
    {
        $licenseMember=LicenseMember::find($licenseMemberId);
        $memberId=$licenseMember->member_id;
        $licenseMember->delete();
        return redirect()->route('members.edit',['member'=>$memberId])->with('success',trans('license.removed'))->withInput(['tab'=>'tab2']);
    }

    /**
     * @param $licenseMemberId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editLicense($licenseMemberId){

        $actualLicensesId=[];
        $licenseMember=LicenseMember::find($licenseMemberId);
        $selectedValidFrom=$licenseMember->valid_from;
        $selectedLicense=$licenseMember->license_id;
        foreach ( Member::find($licenseMember->member_id)->licenseMember as $item) {
            if($item->license_id != $selectedLicense){
                $actualLicensesId[]=$item->license_id;
            }
        }

        $licenses = License::select(DB::raw("CONCAT(description,' (',long_description,')')as license"),'id')
            ->whereNotIn('id', $actualLicensesId)
            ->pluck('license', 'id');

        return view('admin.members.members_edit_license',compact('licenses','licenseMemberId','selectedLicense','selectedValidFrom'));

    }


    public function editLesson($licenseMemberId){

        $actualLicensesId=[];
        $licenseMember=LicenseMember::find($licenseMemberId);
        $selectedValidFrom=$licenseMember->valid_from;
        $selectedLicense=$licenseMember->license_id;
        foreach ( Member::find($licenseMember->member_id)->licenseMember as $item) {
            if($item->license_id != $selectedLicense){
                $actualLicensesId[]=$item->license_id;
            }
        }

        $licenses = License::select(DB::raw("CONCAT(description,' (',long_description,')')as license"),'id')
            ->whereNotIn('id', $actualLicensesId)
            ->pluck('license', 'id');

        return view('admin.members.members_edit_license',compact('licenses','licenseMemberId','selectedLicense','selectedValidFrom'));

    }

    public function unsiscribe($lessonLicenseMemberId){


    }
}
