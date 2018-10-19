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


                /*AlbumsSeeder::class,
                ArticlesSeeder::class,
                CoursesTableSeeder::class,
                CourseStatusTableSeeder::class,
                CourseTypeSeeder::class,
                IncludesSeeder::class,
                LessonLicenseMemberTableSeeder::class,
                LessonsTableSeeder::class,
                LicenseMemberTableSeeder::class,
                LicensesTableSeeder::class,
                LicenseTypeTableSeeder::class,
                SettingsSeeder::class,
                UsersSeeder::class,*/
            ]
        );

    }
}
