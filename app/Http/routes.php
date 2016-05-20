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

$app = app('router');
$api = app('api.router');

$app->auth();

$app->group(['middleware' => ['auth'], 'namespace' => 'CMS'], function ($app) {
    $app->get('/', function () {
        return redirect('/dashboard');
    });

    $app->get('/dashboard', 'DashboardController@index');
});

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
    $api->get('getTwitter', 'SettingsController@getTwitter');
    $api->get('getFloorPlans', 'FloorsController@index');
    $api->get('getInfo', 'PagesController@index');
    $api->get('getLocations', 'LocationsController@index');
    $api->get('getPoi', 'PointsController@index');
    $api->get('checkUpdates', 'UpdatesController@index');
});
