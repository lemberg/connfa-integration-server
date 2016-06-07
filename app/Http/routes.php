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

$api = app('api.router');

$api->version('v2', [
    'middleware' => ['api'],
    'namespace'  => 'App\Http\Controllers\Api',
    'prefix'     => 'api/v2',
], function ($api) {
    $api->get('getSpeakers', 'SpeakersController@index');
    $api->get('getTypes', 'EventTypesController@index');
    $api->get('getLevels', 'EventLevelsController@index');
    $api->get('getTracks', 'EventTracksController@index');
    $api->get('getSessions', 'EventsController@getSessions');
    $api->get('getBofs', 'EventsController@getBofs');
    $api->get('getSocialEvents', 'EventsController@getSocialEvents');
    $api->get('getSettings', 'SettingsController@index');
    $api->get('getFloorPlans', 'FloorsController@index');
    $api->get('getInfo', 'PagesController@index');
    $api->get('getLocations', 'LocationsController@index');
    $api->get('getPOI', 'PointsController@index');
    $api->get('checkUpdates', 'UpdatesController@index');
});
