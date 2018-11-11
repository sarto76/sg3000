<?php

use Illuminate\Database\Seeder;

class LicensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // check if table users is empty
        if(DB::table('licenses')->get()->count() == 0){

            DB::table('licenses')->insert([

                [
                    'description' => 'A',
                    'long_description' => 'Moto grossa',
                    'month_duration' => '4'
                ],
                [
                    'description' => 'B',
                    'long_description' => 'auto',
                    'month_duration' => '24'
                ],
                [
                    'description' => 'A1',
                    'long_description' => 'Moto piccola',
                    'month_duration' => '6'
                ],
                [
                    'description' => 'C',
                    'long_description' => 'Camion',
                    'month_duration' => '24'
                ],

            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
