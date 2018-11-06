<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('course_type')->get()->count() == 0){

            DB::table('course_type')->insert([

                [
                    'description' => 'Moto',
                    'long_description' => 'Corso moto',
                    'number_lessons' => '3',
                    'max_members' => '5'
                ],
                [
                    'description' => 'Sensibilizzazione',
                    'long_description' => 'Corso sensibilizzazione',
                    'number_lessons' => '4',
                    'max_members' => '12'
                ],
                [
                    'description' => 'Soccorritore',
                    'long_description' => 'Corso Soccorritore',
                    'number_lessons' => '6',
                    'max_members' => '15'
                ],
                [
                    'description' => 'Teoria',
                    'long_description' => 'Corso teoria',
                    'number_lessons' => '100',
                    'max_members' => '100'
                ],

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }


    }
}
