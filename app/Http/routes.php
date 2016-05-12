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

Route::get('/', function () {
    return view('welcome');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v2', ['middleware' => ['api'], 'namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api/v2'],
    function ($api) {

        $api->get('getSpeakers', 'SpeakersController@index');
        $api->get('getTypes', 'EventTypesController@index');
        $api->get('getLevels', 'EventLevelsController@index');
        $api->get('getTracks', 'EventTracksController@index');
        $api->get('getSessions', 'EventsController@index')->defaults('type', 'program');
        $api->get('getBofs', 'EventsController@index')->defaults('type', 'bof');
        $api->get('getSocialEvents', 'EventsController@index')->defaults('type', 'social');

    });
