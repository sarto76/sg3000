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
                InstructorsTableSeeder::class,
                PaymentsTableSeeder::class,
                LicenseMemberTableSeeder::class,
                LicensesTableSeeder::class,
                LicenseTypeTableSeeder::class,
                LessonLicenseMemberTableSeeder::class,
                LessonsTableSeeder::class,
                CoursesTableSeeder::class,
                CourseTypeTableSeeder::class,


                /*AlbumsSeeder::class,
                ArticlesSeeder::class,

                CourseStatusTableSeeder::class,

                IncludesSeeder::class,


                SettingsSeeder::class,
                UsersSeeder::class,*/
            ]
        );

    }
}
