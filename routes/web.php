<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostsController@index');
Route::group(['middleware' => ['auth']], function(){
  Route::resource('posts', 'PostsController', ['except' => ['index', 'show']]);
});
Route::resource('posts', 'PostsController', ['only' => ['show']]);

Auth::routes();

Route::get('/login/guest', 'Auth\LoginController@guestLogin');

Route::get('{all}', function() {
  return redirect('/');
});
