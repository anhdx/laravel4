<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>'auth:api'],function(){
	Route::post('/details','api\testController@details');
});
	Route::get('/','api\testController@index');
	// Route::get('/create','api\testController@create');
	Route::post('/store','api\testController@store');
	Route::get('/edit/{id}','api\testController@edit');
	Route::post('/update/{id}','api\testController@update');
	Route::post('/delete/{id}','api\testController@destroy');
	Route::get('/show/{id}','api\testController@show');
	Route::post('/login','api\testController@Login')->name('login');
	Route::post('/register','api\testController@register')->name('register');
	Route::get('/register','api\testController@getRegister');
	// Route::get('/hash',function(){
	// 	dd(Hash::make('123456'));
	// });
