<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
        $user->username = "admin";
        $user->role = 'ADMIN';
        $user->first_name = "sikharin";
        $user->last_name = "kadeeroj";
        $user->email = "admin@ku.th";
        $user->password = Hash::make('123456');
        $user->picture = 'avatar.png';
        $user->email_verified_at = now();
        $user->save();
        $user = new User;
        $user->username = "customer";
        $user->role = 'CUSTOMER';
        $user->first_name = "itsales";
        $user->last_name = "singtaweesak";
        $user->email = "customer@ku.th";
        $user->password = Hash::make('123456');
        $user->picture = 'avatar.png';
        $user->email_verified_at = now();
        $user->save();
      factory(App\User::class, 50)->create();

    }
}
