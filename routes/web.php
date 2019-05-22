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



Route::group(['namespace' => 'Api', 'prefix' => 'api' ], function(){

	Route::GET('createPaymentApi', 'CredCard\CredCardController@createPayment')->name('createPaymentApi');
	Route::POST('createPaymentApi', 'CredCard\CredCardController@createPayment')->name('createPaymentApi');

});


Route::group(['middleware', ['auth'], 'namespace' => 'Local' , 'prefix' => 'local' ], function(){

	Route::GET('createPayment', 'CredCard\CredCardController@createPayment')->name('createPayment');
	Route::POST('createPayment', 'CredCard\CredCardController@createPayment')->name('createPayment');

});





Auth::routes();



Route::get('home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@welcome')->name('/');






