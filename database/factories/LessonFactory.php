<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Lesson::class, function (Faker $faker) {

    $courseId=\App\Models\Course::all()->pluck('id');
    $randId=$faker->randomElement($courseId);
    $instructorId=\App\Models\Instructor::all()->pluck('id');
    $availablesLessons=[];
    $numless=\App\Models\Course::find($randId)->type->number_lessons;

    for($i=1;$i<$numless+1;$i++){
        $availablesLessons[]=$i;
    }



    return [
        'course_id' => $randId,
        'date_time' => $faker->dateTime()->format('d-m-Y H:i'),
        'number' => $faker->randomElement($availablesLessons),
        'instructor_id' => $faker->randomElement($instructorId),
        'status_id' => $faker->numberBetween(1, 3)

    ];
});
