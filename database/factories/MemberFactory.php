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

$factory->define(App\Models\Member::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'nip' =>  $faker->unique()->numberBetween(1000000, 9999999),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'title' => $faker->title(),
        'address' => $faker->address,
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'work' => $faker->phoneNumber,
        'birthdate' => $faker->date(),
        'user_status_id' => $faker->numberBetween(1, 3),
        'instructor_id' => $faker->numberBetween(1, 100),
        'session' => str_random(16)
    ];
});
