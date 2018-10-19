<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Message::class, function (Faker $faker) {
    return [
        'title' => $faker->text,
        'member_id' => $faker->numberBetween(1, 100),
        'instructor_id' => $faker->numberBetween(1, 100),
        'text' => $faker->text
    ];
});
