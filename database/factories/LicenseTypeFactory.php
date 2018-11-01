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

$factory->define(App\Models\LicenseType::class, function (Faker $faker) {
    return [
        'description' => $faker->randomElement(['A' ,'B', 'A1','C','C1']),
        'long_description' =>  $faker->randomElement(['Auto' ,'Moto', 'Scooter','Camion']),
        'month_duration' => $faker->numberBetween(1, 24),
    ];
});
