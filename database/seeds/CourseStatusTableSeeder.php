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
        factory(App\Models\CourseStatus::class, 100)->create();
    }
}
