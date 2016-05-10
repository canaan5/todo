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

use Illuminate\Support\Facades\Session;

Route::group(['middleware' => 'auth'], function() {

    // Restful route for todo
    Route::get('/delete/{id}', 'Todo@destroy');
    Route::resource('/', 'Todo');
    Route::get('/gc', function() {

        $client = new Google_Client();
        $client->setApplicationName('To-Do Application');
        $client->setAuthConfigFile(base_path().'/client_secret.json');
        $client->setAccessType('offline');

        $cal = new Google_Service_Calendar($client);

        $result = $cal->calendarList->listCalendarList();
        echo '<pre>';
        var_dump($result);

    });
});

Route::auth();
