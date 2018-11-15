<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                MembersTableSeeder::class,
                UserStatusTableSeeder::class,
                MessagesTableSeeder::class,
                CourseTypeTableSeeder::class,
                CoursesTableSeeder::class,
                InstructorsTableSeeder::class,
                PaymentsTableSeeder::class,
                LicenseMemberTableSeeder::class,
                LicensesTableSeeder::class,
                StatusTableSeeder::class,
                LessonLicenseMemberTableSeeder::class,
                LessonsTableSeeder::class,


                /*AlbumsSeeder::class,
                ArticlesSeeder::class,



                IncludesSeeder::class,


                SettingsSeeder::class,
                UsersSeeder::class,*/
            ]
        );

    }
}
