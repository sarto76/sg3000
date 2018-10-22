<?php

use Faker\Generator as Faker;


$factory->define(App\Models\Payment::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'member_id' => $faker->numberBetween(1, 100),
        'course_id' => $faker->numberBetween(1, 100),
        'instructor_id' => $faker->numberBetween(1, 100),
        'amount' => $faker->randomFloat(2,100,1000)
    ];
});
