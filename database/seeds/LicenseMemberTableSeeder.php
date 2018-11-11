<?php

use Illuminate\Database\Seeder;

class LicenseMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LicenseMember::class, 100)->create();
    }
}
