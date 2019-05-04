<?php

use Faker\Generator as Faker;

$factory->define(App\ProductImage::class, function (Faker $faker) {
    $products = \App\Product::all();

    return [
        'url' => $faker->imageUrl(500, $height = 500),
        'product_id' => $products->random()->id,
    ];
});
