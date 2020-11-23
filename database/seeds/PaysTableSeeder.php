<?php

use Illuminate\Database\Seeder;

class PaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pay = new App\pay;
        $pay->order_id = 1;
        $pay->user_id = 2;
        $pay->bank = "ธนาคารกรุงเทพ";
        $pay->pay_time = "2019-08-20 18:00:21";
        $pay->first_name = "itsales";
        $pay->last_name = "singtaweesak";
        $pay->price = 1000;
        $pay->picture = "example.jpg";
        $pay->save();
        factory(App\Pay::class, 25)->create();
    }
}
