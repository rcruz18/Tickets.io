<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration{

    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',32)->nullable(false);
            $table->string('lastname',32)->nullable(false);
            $table->string('username',20)->nullable(false)->unique();
            $table->string('email')->unique()->nullable(false);
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token',80)->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });
    }//end function

    public function down(){
        Schema::dropIfExists('users');
    }//end function
}//end class
