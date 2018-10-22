<?php

use Illuminate\Database\Seeder;

class LessonLicenseMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LessonLicenseMember::class, 100)->create();
    }
}
