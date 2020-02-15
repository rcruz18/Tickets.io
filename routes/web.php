<?php
Route::get('/', ['middleware' => 'auth', function () {
    return view('/dashboard');
}]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
 Route::resource('user', 'UserController', ['except' => ['show']]);
 Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
 Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
 Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
