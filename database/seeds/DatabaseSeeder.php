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
                StatusTableSeeder::class,
                UserStatusTableSeeder::class,
                LicensesTableSeeder::class,
                MembersTableSeeder::class,
                MessagesTableSeeder::class,
                CourseTypeTableSeeder::class,
                InstructorsTableSeeder::class,
                CoursesTableSeeder::class,
                PaymentsTableSeeder::class,
                LessonsTableSeeder::class,
                LicenseMemberTableSeeder::class,
                LessonLicenseMemberTableSeeder::class,



                /*AlbumsSeeder::class,
                ArticlesSeeder::class,



                IncludesSeeder::class,


                SettingsSeeder::class,
                UsersSeeder::class,*/
            ]
        );

    }
}
