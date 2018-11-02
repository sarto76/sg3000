<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'course_type_id' => $faker->numberBetween(1, 4),
        'course_status_id' => $faker->numberBetween(1, 3),
        'facebook' => str_random(16)
    ];
});
