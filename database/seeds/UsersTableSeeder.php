<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder{

    public function run(){
      DB::table('users')->insert([
       'name' => 'Administrator',
       'lastname' => 'DevoLabs',
       'username' => 'administrator',
       'email' => 'support@devolabs.io',
       'password' => Hash::make('ACeYO4m2'),
       'api_token' => Str::random(60),
      ]);

    }//end function
}//end class
