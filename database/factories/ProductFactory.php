<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'detail' => $faker->text(100),
        'unit_price' => $faker->numberBetween(0, 200)
    ];
});
