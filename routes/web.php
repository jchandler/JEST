<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->get('sightings',  ['uses' => 'SightingController@showAllSightings']);
  $router->get('sightings/{id}', ['uses' => 'SightingController@showOneSighting']);
  $router->post('sightings', ['uses' => 'SightingController@create']);
  $router->delete('sightings/{id}', ['uses' => 'SightingController@delete']);
  $router->put('sightings/{id}', ['uses' => 'SightingController@update']);

  $router->get('sightings/distance/{id1}/{id2}', ['uses' => 'SightingController@distanceBetweenTwo']);
});