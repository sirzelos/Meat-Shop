<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Address;
use App\Order;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
        $user->username = "Customer2";
        $user->role = 'CUSTOMER';
        $user->first_name = "pattalapon";
        $user->last_name = "pontaku";
        $user->email = "folk@ku.th";
        $user->password = Hash::make('123456');
        $user->picture = 'avatar.png';
        $user->email_verified_at = now();
        $user->save();

      $address = new Address;
      $address->user_id = $user->id;
      $address->house_address = '702/12';
      $address->street = 'พหลโยธิน32';
      $address->sub_district = 'จันทรเกษม';
      $address->district = 'จตุจักร';
      $address->province = 'กรุงเทพมหานคร';
      $address->zip_code = '10900';
      $address->save();


      factory(\App\Order::class,50)->create([
          'address_id' => $address->id,
          'user_id' => $user->id
      ]);
    }
}
