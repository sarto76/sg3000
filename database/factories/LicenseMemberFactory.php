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

$factory->define(App\Models\LicenseMember::class, function (Faker $faker) {
    return [
        'license_id' => $faker->numberBetween(1, 4),
        'member_id' =>  $faker->numberBetween(1, 1000),
        'valid_from' => $faker->date()
    ];
});
