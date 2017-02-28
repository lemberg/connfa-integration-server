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
        return redirect()->route('conferences.index');
    });
    $app->get('conferences/data', 'ConferencesController@getData')->name('conferences.data');
    $app->get('conferences', 'ConferencesController@index')->name('conferences.index');
    $app->get('conferences/create', 'ConferencesController@create')->name('conferences.create');
    $app->post('conferences', 'ConferencesController@store')->name('conferences.store');
    $app->get('conferences/{id}/edit', 'ConferencesController@edit')->name('conferences.edit');
    $app->put('conferences/{id}', 'ConferencesController@update')->name('conferences.update');
    $app->delete('conferences/{id}', 'ConferencesController@destroy')->name('conferences.destroy');
});

$app->group(['middleware' => ['auth'], 'namespace' => 'CMS', 'prefix' => '{conference_alias}'], function ($app) {
    $app->get('speakers/data', 'SpeakersController@getData')->name('speakers.data');
    $app->get('sessions/data', 'Events\SessionsController@getData')->name('sessions.data');
    $app->get('bofs/data', 'Events\BofsController@getData')->name('bofs.data');
    $app->get('social/data', 'Events\SocialController@getData')->name('social.data');
    $app->get('dashboard', 'DashboardController@index')->name('dashboard');

    // Levels
    $app->get('levels', 'Events\LevelsController@index')->name('levels.index');
    $app->get('levels/create', 'Events\LevelsController@create')->name('levels.create');
    $app->post('levels', 'Events\LevelsController@store')->name('levels.store');
    $app->get('levels/{id}', 'Events\LevelsController@show')->name('levels.show');
    $app->get('levels/{id}/edit', 'Events\LevelsController@edit')->name('levels.edit');
    $app->put('levels/{id}', 'Events\LevelsController@update')->name('levels.update');
    $app->delete('levels/{id}', 'Events\LevelsController@destroy')->name('levels.destroy');

    // Tracks
    $app->get('tracks', 'Events\TracksController@index')->name('tracks.index');
    $app->get('tracks/create', 'Events\TracksController@create')->name('tracks.create');
    $app->post('tracks', 'Events\TracksController@store')->name('tracks.store');
    $app->get('tracks/{id}', 'Events\TracksController@show')->name('tracks.show');
    $app->get('tracks/{id}/edit', 'Events\TracksController@edit')->name('tracks.edit');
    $app->put('tracks/{id}', 'Events\TracksController@update')->name('tracks.update');
    $app->delete('tracks/{id}', 'Events\TracksController@destroy')->name('tracks.destroy');

    // Types
    $app->get('types', 'Events\TypesController@index')->name('types.index');
    $app->get('types/create', 'Events\TypesController@create')->name('types.create');
    $app->post('types', 'Events\TypesController@store')->name('types.store');
    $app->get('types/{id}', 'Events\TypesController@show')->name('types.show');
    $app->get('types/{id}/edit', 'Events\TypesController@edit')->name('types.edit');
    $app->put('types/{id}', 'Events\TypesController@update')->name('types.update');
    $app->delete('types/{id}', 'Events\TypesController@destroy')->name('types.destroy');
    
    // Speakers
    $app->get('speakers', 'SpeakersController@index')->name('speakers.index');
    $app->get('speakers/create', 'SpeakersController@create')->name('speakers.create');
    $app->post('speakers', 'SpeakersController@store')->name('speakers.store');
    $app->get('speakers/{id}', 'SpeakersController@show')->name('speakers.show');
    $app->get('speakers/{id}/edit', 'SpeakersController@edit')->name('speakers.edit');
    $app->put('speakers/{id}', 'SpeakersController@update')->name('speakers.update');
    $app->delete('speakers/{id}', 'SpeakersController@destroy')->name('speakers.destroy');

    // Points
    $app->get('points', 'PointsController@index')->name('points.index');
    $app->get('points/create', 'PointsController@create')->name('points.create');
    $app->post('points', 'PointsController@store')->name('points.store');
    $app->get('points/{id}', 'PointsController@show')->name('points.show');
    $app->get('points/{id}/edit', 'PointsController@edit')->name('points.edit');
    $app->put('points/{id}', 'PointsController@update')->name('points.update');
    $app->delete('points/{id}', 'PointsController@destroy')->name('points.destroy');

    // Floors
    $app->get('floors', 'FloorsController@index')->name('floors.index');
    $app->get('floors/create', 'FloorsController@create')->name('floors.create');
    $app->post('floors', 'FloorsController@store')->name('floors.store');
    $app->get('floors/{id}', 'FloorsController@show')->name('floors.show');
    $app->get('floors/{id}/edit', 'FloorsController@edit')->name('floors.edit');
    $app->put('floors/{id}', 'FloorsController@update')->name('floors.update');
    $app->delete('floors/{id}', 'FloorsController@destroy')->name('floors.destroy');

    // Pages
    $app->get('pages', 'PagesController@index')->name('pages.index');
    $app->get('pages/create', 'PagesController@create')->name('pages.create');
    $app->post('pages', 'PagesController@store')->name('pages.store');
    $app->get('pages/{id}', 'PagesController@show')->name('pages.show');
    $app->get('pages/{id}/edit', 'PagesController@edit')->name('pages.edit');
    $app->put('pages/{id}', 'PagesController@update')->name('pages.update');
    $app->delete('pages/{id}', 'PagesController@destroy')->name('pages.destroy');

    // Sessions
    $app->get('sessions', 'Events\SessionsController@index')->name('sessions.index');
    $app->get('sessions/create', 'Events\SessionsController@create')->name('sessions.create');
    $app->post('sessions', 'Events\SessionsController@store')->name('sessions.store');
    $app->get('sessions/{id}', 'Events\SessionsController@show')->name('sessions.show');
    $app->get('sessions/{id}/edit', 'Events\SessionsController@edit')->name('sessions.edit');
    $app->put('sessions/{id}', 'Events\SessionsController@update')->name('sessions.update');
    $app->delete('sessions/{id}', 'Events\SessionsController@destroy')->name('sessions.destroy');

    // Bofs
    $app->get('bofs', 'Events\BofsController@index')->name('bofs.index');
    $app->get('bofs/create', 'Events\BofsController@create')->name('bofs.create');
    $app->post('bofs', 'Events\BofsController@store')->name('bofs.store');
    $app->get('bofs/{id}', 'Events\BofsController@show')->name('bofs.show');
    $app->get('bofs/{id}/edit', 'Events\BofsController@edit')->name('bofs.edit');
    $app->put('bofs/{id}', 'Events\BofsController@update')->name('bofs.update');
    $app->delete('bofs/{id}', 'Events\BofsController@destroy')->name('bofs.destroy');

    // Social
    $app->get('social', 'Events\SocialController@index')->name('social.index');
    $app->get('social/create', 'Events\SocialController@create')->name('social.create');
    $app->post('social', 'Events\SocialController@store')->name('social.store');
    $app->get('social/{id}', 'Events\SocialController@show')->name('social.show');
    $app->get('social/{id}/edit', 'Events\SocialController@edit')->name('social.edit');
    $app->put('social/{id}', 'Events\SocialController@update')->name('social.update');
    $app->delete('social/{id}', 'Events\SocialController@destroy')->name('social.destroy');

    // Location
    $app->get('location', 'LocationsController@index')->name('location.index');
    $app->get('location/edit', 'LocationsController@edit')->name('location.edit');
    $app->put('location', 'LocationsController@update')->name('location.update');

    // Settings
    $app->get('settings', 'SettingsController@index')->name('settings.index');
    $app->get('settings/edit', 'SettingsController@edit')->name('settings.edit');
    $app->put('settings', 'SettingsController@update')->name('settings.update');

    $app->group(['middleware' => ['permission:edit-user']], function($app) {
        // Users
        $app->get('users', 'UsersController@index')->name('users.index');
        $app->get('users/create', 'UsersController@create')->name('users.create');
        $app->post('users', 'UsersController@store')->name('users.store');
        $app->get('users/{id}', 'UsersController@show')->name('users.show');
        $app->get('users/{id}/edit', 'UsersController@edit')->name('users.edit');
        $app->put('users/{id}', 'UsersController@update')->name('users.update');
        $app->delete('users/{id}', 'UsersController@destroy')->name('users.destroy');
    });
});

$api->version('v2', [
    'middleware' => ['api'],
    'namespace'  => 'App\Http\Controllers\Api',
    'prefix'     => 'api/v2/{conference_alias}',
], function ($api) {
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
