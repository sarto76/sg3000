<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Routing\RequestContext;
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

        $members=\App\Models\Member::orderBy('created_at', 'asc')->paginate(15);
        //print_r($members);

        /*return view('member',[
            'members' => $members
        ]);*/

        return view('pages.member.show',compact('members'));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=> 'required|max:50',
            'firstname' => 'required|max:100',
            'lastname'  => 'required|max:100',
            'email'     => 'email',
            'address'=> 'max:100',
            'zip'=> 'min:1000|max:9999|numeric',
            'city'=> 'max:100',
            'phone'=> 'max:100',
            'mobile'=> 'max:100',
            'work'=> 'max:100',
            'birthdate'=> 'date',

        ]);


        if($validator->fails()){
            return redirect()
                ->route('member.create')
                ->withInput()
                ->withErrors($validator);
        }
        $member=new \App\Models\Member();

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
        $member->birthdate=$request->birthdate;






        $member->save();
        return redirect()->route('member.index')->with('success','Member Added');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
