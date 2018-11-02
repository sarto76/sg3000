<?php

use Faker\Generator as Faker;


$factory->define(App\Models\LessonLicenseMember::class, function (Faker $faker) {
    return [
        'lesson_id' => $faker->numberBetween(1, 100),
        'notes' => $faker->sentence,
        'license_member_id' => $faker->numberBetween(1, 100),
    ];
});
