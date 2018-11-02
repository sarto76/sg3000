<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Lesson::class, function (Faker $faker) {
    return [
        'course_id' => $faker->numberBetween(1, 100),
        'date_time' => $faker->dateTime(),
        'number' => $faker->numberBetween(1, 4),
        'instructor_id' => $faker->numberBetween(1, 100),
        'course_status_id' => $faker->numberBetween(1, 5)

    ];
});
