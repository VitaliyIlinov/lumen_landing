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

$router->get('/', function () {
    return redirect()->route('home');
});
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/', ['middleware' => 'Fraud', 'as' => 'home', 'uses' => 'LandingController@page']);
    $router->get('/phone_check', 'LandingController@responsePhoneChecker');
    $router->post('/track_params', 'LandingController@getTrackParams');
    $router->post('/send', 'LandingController@send');
    /**
     * Diagnostic endpoints
     */
    $router->group(['middleware' => 'KeyDefense'], function () use ($router) {
        $router->group(['prefix' => 'safe'], function () use ($router) {
            $router->get('/', ['as' => 'safe', 'uses' => 'LandingController@getSafePage']);
        });

        $router->group(['prefix' => 'money'], function () use ($router) {
            $router->get('/', ['as' => 'money', 'uses' => 'LandingController@getMoneyPage']);
        });

        $router->get('/test', 'LandingController@test');

        $router->get('/getState', 'ApiController@getState');
        $router->get('/getHeartbeat', 'ApiController@getHeartbeat');
        $router->get('/getLogs', 'ApiController@getLogs');
    });
    $router->get('/error', function () {
        return view('errors.error');
    });
});