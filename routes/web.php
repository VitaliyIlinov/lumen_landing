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



$router->group(['prefix' => 'safe'], function () use ($router) {
    $router->get('/', 'LandingController@safe');
});
$router->group(['prefix' => 'money'], function () use ($router) {
    $router->get('/', 'LandingController@money');
});

$router->post('/phone_check', 'LandingController@responsePhoneChecker');
$router->post('/track_params', 'LandingController@getTrackParams');
$router->post('/send', 'LandingController@send');
$router->get('/test', 'LandingController@test');

