<?php

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->randomHtml(),
        'image' => $faker->word,
        'published_from' => null,
        'published_until' => null,
        'price' => min(100, 1000)
    ];
});
