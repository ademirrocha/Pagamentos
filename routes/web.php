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



Route::group(['middleware' => 'cors', 'namespace' => 'Api', 'prefix' => 'api' ], function(){

	//Route::GET('createPaymentApi', 'CredCard\CredCardController@createPayment')->name('createPaymentApi');
	Route::POST('createPaymentApi', 'CredCard\CredCardController@createPayment')->name('createPaymentApi');

});


Route::group(['middleware', ['auth'], 'namespace' => 'Local' , 'prefix' => 'local' ], function(){

	Route::GET('teste/pagamentos/cred_card', 'CredCard\CredCardController@formTestPaymant')->name('teste/pagamentos/cred_card');
	Route::POST('teste/createPayment/pagamentos/cred_card', 'CredCard\CredCardController@createPayment')->name('teste/createPayment/pagamentos/cred_card');

});





Auth::routes();



Route::get('home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@home')->name('/');



Auth::routes();
