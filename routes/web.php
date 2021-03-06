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

Route::view('/', 'contact');



///////////////////////////////MEMBERS///////////////////////////////

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    //Route::get('members/anydata', 'MemberController@anyData')->name('members.anydata');
    Route::get('members/search', 'MemberController@search')->name('members.search');
    Route::get('members/addLicense/{memberId}', 'MemberController@addLicense')->name('members.addLicense');
    Route::post('members/storeLicense', 'MemberController@storeLicense')->name('members.storeLicense');
    Route::post('members/updateLicense', 'MemberController@updateLicense')->name('members.updateLicense');
    Route::delete('members/removeLicense/{licenseMemberId}', 'MemberController@removeLicense')->name('members.removeLicense');
    Route::delete('members/removeMember/{lessonLicenseMemberId}', 'MemberController@removeMember')->name('members.removeMember');
    Route::get('members/editLessonInscription/{lessonLicenseMemberId}', 'MemberController@editLessonInscription')->name('members.editLessonInscription');
    Route::get('members/editLicense/{licenseMemberId}', 'MemberController@editLicense')->name('members.editLicense');
    Route::get('members/getAvailablesLessons', 'MemberController@getAvailablesLessons')->name('members.getAvailablesLessons');
    Route::post('members/addLesson/{lessonId}', 'MemberController@addLesson')->name('members.addLesson');

    Route::resource('members', 'MemberController');

    Route::get('lessons/search/{type}', 'LessonController@search')->name('lessons.search');
    Route::get('lessons/create/{idCourse}', 'LessonController@create')->name('lessons.create');
    Route::get('lessons/index/{type}', 'LessonController@index')->name('lessons.index');
    Route::get('lessons/getMembers', 'LessonController@getMembers')->name('lessons.getMembers');
    Route::get('lessons/getMembersDirect', 'LessonController@getMembersDirect')->name('lessons.getMembersDirect');
    Route::post('lessons/addMember/{licenseMemberId}', 'LessonController@addMember')->name('lessons.addMember');
    Route::delete('lessons/removeMember/{lessonLicenseMemberId}', 'LessonController@removeMember')->name('lessons.removeMember');
    //Route::post('lessons/editLessonLicenseMember/{lessonLicenseMemberId}', 'LessonController@editLessonLicenseMember')->name('lessons.editLessonLicenseMember');
    Route::post('lessons/editLessonLicenseMember', 'LessonController@editLessonLicenseMember')->name('lessons.editLessonLicenseMember');
    Route::delete('lessons/removeCourse/{courseId}', 'LessonController@removeCourse')->name('lessons.removeCourse');
    Route::resource('lessons', 'LessonController', array('except' => array('create', 'index')));
    Route::resource('courses', 'CourseController', array('except' => array('index','show')));
});

/*Route::get('datatable', 'Web\MemberController@getIndex');
Route::get('member', 'Web\MemberController@getIndex')->name('member');
Route::get('member/{id}/edit', 'Web\MemberController@edit');
Route::post('/member/update', 'Web\MemberController@update')->name('member.update');


Route::get('datatable/anyData', 'Web\MemberController@anyData')->name('datatable/anyData');
Route::get('member/anyData', 'Web\MemberController@anyData')->name('memberAnyData');


Route::get('/member/create', 'Web\MemberController@create')->name('memberCreate');
Route::post('/member/store', 'Web\MemberController@store')->name('memberStore');
Route::delete('/member/{id}',array('uses' => 'Web\MemberController@destroy', 'as' => 'memberDestroy'));*/






//Route::get('member/index', 'Web\MemberController@index')->name('member/index');
/*Route::get('/',function(){
    $members=\App\Models\Member::orderBy('created_at', 'asc')->get();

    return view('member',[
        'members' => $members
    ]);
});*/

/*Route::controller('datatables', 'MemberController', [
    'anyData'  => 'datatables.data',
    'getIndex' => 'datatables',
]);*/

//Route::get('/members', 'Web\MemberController@index')->name('member.index');
// Route::get('/members', 'api\MemberController@index');
//Route::resource('/member', 'Web\MemberController');
/*Route::post('/member',function(\Illuminate\Http\Request $request){
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

});*/


/*Route::delete('/member/{id}', function ($id) {
    \App\Models\Member::findOrFail($id)->delete();

    return redirect('/');
});*/

///////////////LESSONS///////////////