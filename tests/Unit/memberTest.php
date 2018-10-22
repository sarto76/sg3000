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
    public function testExample()
    {
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


        $lic=new License();
        $lic->license_type_id=12;
        $lic->text="cat A";
        $lic->save();


        $member->licenses()->attach($lic,['valid_from' =>'2018-01-10']);


        $mem=Member::where('email','mario@gmail.com')->first();

        $licenses=$mem->licenses;
        $text="";
        foreach($licenses as $license){
            $text=$license->text;
        }




        $this->assertEquals("cat A",$text);



    }
}
