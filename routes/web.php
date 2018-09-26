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
$router->get('/', ['middleware' => 'Fraud', 'as' => 'home', 'uses' => 'LandingController@page']);
$router->post('/send', 'LandingController@send');

//get all params
$router->post('/track_params', 'LandingController@getTrackParams');

//for validation
$router->get('/checkemail', 'LandingController@checkEmail');
$router->get('/checkphone', 'LandingController@checkPhone');
$router->get('/validatephone', 'LandingController@validatePhone');
$router->post('/checkcode', 'LandingController@checkCode');
$router->post('/geoip', 'LandingController@getGeoIP');


$router->get('/error', function () {
    return view('errors.error');
});

$router->group(['middleware' => 'KeyDefense'], function () use ($router) {

    $router->get('/safe', ['as' => 'safe', 'uses' => 'LandingController@getSafePage']);
    $router->get('/money', ['as' => 'money', 'uses' => 'LandingController@getMoneyPage']);

    /**
     * Diagnostic endpoints
     */
    $router->group(['prefix' => 'api'], function () use ($router) {
        $router->get('/getState', 'ApiController@getState');
        $router->get('/getHeartbeat', 'ApiController@getHeartbeat');
        $router->get('/getLogs', 'ApiController@getLogs');
    });
});