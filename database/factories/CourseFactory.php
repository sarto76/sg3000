<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'course_type_id' => $faker->numberBetween(1, 4),
        'facebook' => str_random(16)
    ];
});
