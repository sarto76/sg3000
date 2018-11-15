<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if(DB::table('status')->get()->count() == 0){

            DB::table('status')->insert([

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
