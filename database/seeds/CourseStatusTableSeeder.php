<?php

use Illuminate\Database\Seeder;

class CourseStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(DB::table('course_status')->get()->count() == 0){

            DB::table('course_status')->insert([

                [
                    'description' => 'aperto',
                    'color' => 'green',
                ],
                [
                    'description' => 'chiuso',
                    'color' => 'red',

                ],
                [
                    'description' => 'nascosto',
                    'color' => 'orange',
                ],

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
