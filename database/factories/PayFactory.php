<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pay;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Pay::class, function (Faker $faker) {
    return [
        'order_id' => $faker->numberBetween(1, 200),
        'user_id' => $faker->numberBetween(1, 200),
        'bank' => $faker->text(100),
        'pay_time' => $faker->dateTime($min = 'now', $timezone = null),
        'first_name' => $faker->firstname,
        'last_name' => $faker->lastname,
        'price' => $faker->numberBetween(0, 200),
        'picture' => 'example.jpg',
    ];
});
