<?php
/**
 * Created by PhpStorm.
 * User: massimo
 * Date: 18.10.18
 * Time: 17:45
 */

$members=App\Models\Member::all();

foreach($member as $member){
    echo $member->firstname;
}