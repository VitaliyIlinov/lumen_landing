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

/**
 * @var $router \Laravel\Lumen\Routing\Router
 */

//$router->get('/', function () use ($router) {
//    return $router->app->version();
//});

$router->group(['middleware' => 'Trap'], function () use ($router) {
    $router->get('/trap', ['as' => 'trap', 'uses' => 'TrapController@blackList']);
    $router->get('/', ['middleware' => ['Fraud','InjectView'], 'as' => 'home', 'uses' => 'LandingController@page']);
    $router->post('/send', 'LandingController@send');
    //get all params
    $router->post('/track_params', 'LandingController@getTrackParams');
    $router->post('/subscribe', 'LandingController@getSubscriberInfo');
    //for validation
    $router->post('/checkemail', 'LandingController@checkEmail');
    $router->post('/checkphone', 'LandingController@checkPhone');
    $router->post('/validatephone', 'LandingController@validatePhone');
    $router->post('/checkcode', 'LandingController@checkCode');
    $router->post('/geoip', 'LandingController@getGeoCountry');
    $router->post('/ip', 'LandingController@getClientIp');


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
            $router->get('/getBlacklist', 'TrapController@getBlacklist');
        });
    });
});