<?php

namespace Tests\Unit;

use App\Models\Instructor;
use App\Models\License;
use App\Models\Member;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class memberTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddMemberAddLicenseAssertTrue()
    {

        //addMemberAddLicenseAndCancelAll
        $member=new Member();

        $member->email='mario@gmail.com';
        $member->nip='1234454';
        $member->firstname='Mario';
        $member->lastname='Cipolla';
        $member->title='Mr';
        $member->address='via Galli 12';
        $member->zip=6900;
        $member->city='Lugano';
        $member->phone='0912345433';
        $member->mobile='0791234343';
        $member->work='0916767766';
        $member->birthdate='1990-12-25';
        $member->user_status_id='1';
        $member->instructor_id='12';
        $member->session='123';
        $member->save();
        $id=$member->id;

        $lic=new License();
        $lic->description="cat prova";
        $lic->long_description="categoria di prova";
        $lic->month_duration="4";
        $lic->save();


        $member->licenses()->attach($lic->id,['valid_from' =>'2018-01-10']);


        $mem=Member::find($id);

        $licenses=$mem->licenses;
        $description='';
        foreach($licenses as $license){
            $description=$license->description;
        }
        $this->assertEquals("cat prova",$description);
    }




    public function testDeleteMemberWithLicenseTrue()
    {

        //addMemberAddLicenseAndCancelAll
        $member=new Member();

        $member->email='mario@gmail.com';
        $member->nip='1234454';
        $member->firstname='Mario';
        $member->lastname='Cipolla';
        $member->title='Mr';
        $member->address='via Galli 12';
        $member->zip=6900;
        $member->city='Lugano';
        $member->phone='0912345433';
        $member->mobile='0791234343';
        $member->work='0916767766';
        $member->birthdate='1990-12-25';
        $member->user_status_id='1';
        $member->instructor_id='12';
        $member->session='123';
        $member->save();
        $id=$member->id;

        $lic=new License();
        $lic->description="cat prova";
        $lic->long_description="categoria di prova";
        $lic->month_duration="4";
        $lic->save();


        $member->licenses()->attach($lic->id,['valid_from' =>'2018-01-10']);


        $member->licenses()->detach($lic->id);
        $member->save();


        $this->assertEquals(0,count($member->licenses));

    }


}
