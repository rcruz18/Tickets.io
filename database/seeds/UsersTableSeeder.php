<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder{

    public function run(){
        DB::table('users')->insert([
            'name' => 'Administrator',
            'lastname' => 'DevoLabs',
            'username' => 'administrator',
            'email' => 'support@devolabs.io',
            'password' => Hash::make('secret'),
            'api_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }//end function
}//end class
