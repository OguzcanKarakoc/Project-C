<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'postcode' => $faker->postcode,
        'city' => $faker->city,
        'street' => $faker->streetName,
        'house_number' => $faker->buildingNumber,
        'delivery_address' => $faker->boolean,
    ];
});
