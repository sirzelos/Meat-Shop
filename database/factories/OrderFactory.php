<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
      'total_price' =>  $faker->numberBetween(200,50000),
      'status' => $faker->randomElement(['ยังไม่ชำระเงิน','กำลังตรวจสอบการชำระเงิน','ชำระเงินผิดพลาด','ชำระเงินถูกต้องกำลังเตรียมส่ง','จัดส่งเรียบร้อย']),
    ];
});
