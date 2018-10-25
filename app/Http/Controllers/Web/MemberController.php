<?php

namespace App\Http\Controllers\Web;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Routing\RequestContext;
use Validator;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{


    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('pages.member.index');
    }

    public function anyData()
    {

        //$this->members=Datatables::of(Member::select('email','firstname','lastname','address','zip','city','phone','mobile','work','birthdate'))->make(true);

        $members = DB::table('members')
            ->select(['id','email','firstname','lastname','address','zip','city','phone','mobile','work', DB::raw('DATE_FORMAT(birthdate, "%d-%m-%Y") as birthdate')]);



        return Datatables::of($members)
            ->addColumn('action', function ($id) {
                return '<a href="member/' . $id->id . '/edit" class="btn btn-primary">Edit</a>
                        <button class="btn btn-primary btn-delete" data-remote="/member/' . $id->id . '">Delete</button>
                  '; })->make(true);


    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return view('pages.member.create');
    }

    public function store2(Request $request)
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
                ->route('memberCreate')
                ->withInput()
                ->withErrors($validator);
        }
        $member=Member::updateOrCreate(
            [
                'id'  => Member::id,
                'title'=> $request->title,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
                'address'=> $request->address,
                'zip'=> $request->zip,
                'city'=> $request->city,
                'phone'=> $request->phone,
                'mobile'=> $request->mobile,
                'work'=> $request->work,
                'birthdate'=> Carbon::parse($request->birthdate)->format('Y-m-d')
            ]
        );


        $member->save();
        return redirect()->route('member')->with('success','Member Added');
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
                ->route('memberCreate')
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
        return redirect()->route('member')->with('success','Member Added');

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
        return view('pages.member.edit',compact('member','id'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = \App\Models\Member::findOrFail($id)->delete();
        return redirect('/member')->with('success','Information has been  deleted');
    }
}
