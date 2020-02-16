<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Inspiring;

class LoginController extends Controller{

    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }//end function

    public function username(){
      return 'username';
    }//end function
}//end class
