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

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});
//

$router->group(['middleware' => 'prepare'], function () use ($router) {

    $router->group(['prefix' => 'safe','middleware' => 'prepare'], function () use ($router) {
        $router->get('/', 'LandingController@getSavePage');
    });

    $router->group(['prefix' => 'money','middleware' => 'prepare'], function () use ($router) {
        $router->get('/', 'LandingController@getMoneyPage');
    });

    $router->get('/test', 'LandingController@test');
});


$router->get('/', 'LandingController@page');
$router->get('/phone_check', 'LandingController@responsePhoneChecker');
$router->post('/track_params', 'LandingController@getTrackParams');
$router->post('/send', 'LandingController@send');

$router->get('/404', function () {
    return view('errors.404');
});

