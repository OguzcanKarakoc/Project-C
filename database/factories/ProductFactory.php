<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $productStatuses = \App\ProductStatus::all()->pluck('id');

    return [
        'title' => $faker->sentence(3, true),
        'description' => $faker->sentence(50, true),
        'price' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(3),
        'product_status_id' => $productStatuses->random(),
    ];
});