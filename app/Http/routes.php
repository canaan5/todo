<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'auth'], function() {

    // Restful routes
    Route::get('/delete/{id}', 'Todo@destroy');
    Route::resource('/', 'Todo');

    // Routes to Sync with google calender
    Route::get('/calender', 'Todo@calender');
    Route::get('/sync/authenticate', 'Todo@authenticate');
});


Route::auth();
