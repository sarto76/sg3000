<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // check if table users is empty
        if(DB::table('license_type')->get()->count() == 0){

            DB::table('license_type')->insert([

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
