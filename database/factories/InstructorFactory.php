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

$factory->define(App\Models\Instructor::class, function (Faker $faker) {
    return [
        'init' => str_random(2),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->title(),
        'birthdate' => $faker->date(),
        'mobile' => $faker->phoneNumber,
        'password' => str_random(16),
        'session' => str_random(16),
        'user_status_id' => $faker->numberBetween(1, 3),
        'pushover' => str_random(16),
        'label' => str_random(16),
        'rank' => $faker->numberBetween(1, 20),
        'image' => str_random(16)
    ];
});
