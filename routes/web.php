<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/',function(){
    $members=\App\Models\Member::orderBy('created_at', 'asc')->get();

    return view('members',[
        'members' => $members
    ]);
});

Route::post('/member',function(\Illuminate\Http\Request $request){
    $validator=Validator::make($request->all(),[
        'firstname' => 'required|max:100'
        ]);





    if($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    $member=new \App\Models\Member();
    $member->firstname=$request->firstname;
    $member->save();
    return redirect('/');

});


Route::delete('/member/{id}', function ($id) {
    \App\Models\Member::findOrFail($id)->delete();

    return redirect('/');
});