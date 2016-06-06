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

/**
 * CMS routes
 */
$app->group(['middleware' => ['auth'], 'namespace' => 'CMS'], function ($app) {
    $app->get('/', function () {
        return redirect('/dashboard');
    });
    $app->get('/dashboard', 'DashboardController@index')->name('dashboard');
    $app->resource('levels', 'Events\LevelsController');
    $app->resource('tracks', 'Events\TracksController');
    $app->resource('types', 'Events\TypesController');
    $app->resource('speakers', 'SpeakersController');
    $app->resource('points', 'PointsController');
    $app->resource('locations', 'LocationsController');
    $app->resource('floors', 'FloorsController');
    $app->resource('pages', 'PagesController');
    $app->resource('users', 'UsersController');
    $app->resource('sessions', 'Events\SessionsController');
    $app->resource('bofs', 'Events\BofsController');
    $app->get('settings', 'SettingsController@index')->name('settings.index');
    $app->get('settings/edit', 'SettingsController@edit')->name('settings.edit');
    $app->put('settings', 'SettingsController@update')->name('settings.update');
});

/**
 * API routes
 */
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
