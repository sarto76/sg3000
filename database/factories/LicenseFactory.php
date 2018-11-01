<?php

use Faker\Generator as Faker;


$factory->define(App\Models\License::class, function (Faker $faker) {
    return [
        'license_type_id' => $faker->numberBetween(1, 100),
        'text' => str_random(16)
    ];
});
