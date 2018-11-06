<?php

namespace App\Http\Controllers\admin;

use App\Models\Member;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use Symfony\Component\Routing\RequestContext;
use Validator;
use Yajra\DataTables\DataTables;

class MemberController_JS extends Controller
{

    public function anyData()
    {
        $members = DB::table('members')
            ->select(['id','email','firstname','lastname','address','zip','city','phone','mobile','work', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate')])
             ->whereNull('deleted_at');

        return Datatables::of($members)
            ->addColumn('action', function ($id) {
                return '<a href="members/' . $id->id . '/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i></a>
                        <button class="btn btn-danger btn-xs btn-delete" data-remote="/admin/members/' . $id->id . '">
                        <i class="fa fa-trash-o" title="Delete"></i>
                        </button>
                  '; })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.members.members_index');

        //return Datatables::of(Member::select('email','firstname','lastname','address','zip','city','phone','mobile','work','birthdate'))->make(true);
        //$members=\App\Models\Member::orderBy('lastname', 'asc')->get();
        //print_r($members);

        //return view('pages.member.show',compact('members'));
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
        //
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
