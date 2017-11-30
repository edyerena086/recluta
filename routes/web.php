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

Route::get('/', function () {
    return view('welcome');
});

/**
 * -----------------------------------------------------------------------
 * Candidate Routes
 * -----------------------------------------------------------------------
 * 
 */
Route::group(['prefix' => 'candidate'], function () {
	Route::get('/', 'Front\Candidate\AccountController@index');

	/**
	 * -------------------------------------------------------------------
	 * Account Routes
	 * -------------------------------------------------------------------
	 * 
	 */
	Route::group(['prefix' => 'account'], function () {
		Route::post('login', 'Front\Candidate\AccountController@login');

		Route::get('create', 'Front\Candidate\AccountController@create');
		Route::post('store', 'Front\Candidate\AccountController@store');

		Route::group(['prefix' => 'password'], function () {
			Route::get('recover', 'Front\Candidate\AccountController@getRecover');
			Route::post('recover', 'Front\Candidate\AccountController@postRecover');
		});
	});
});
