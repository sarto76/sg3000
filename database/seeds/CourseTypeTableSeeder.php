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
                    'number_lessons' => '3'
                ],
                [
                    'description' => 'Sensibilizzazione',
                    'long_description' => 'Corso sensibilizzazione',
                    'number_lessons' => '4'
                ],
                [
                    'description' => 'Soccorritore',
                    'long_description' => 'Corso Soccorritore',
                    'number_lessons' => '6'
                ],
                [
                    'description' => 'Teoria',
                    'long_description' => 'Corso teoria',
                    'number_lessons' => '100'
                ],

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }


    }
}
