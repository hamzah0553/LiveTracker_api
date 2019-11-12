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

// ALL routers here!
$router->group(['prefix'=>'api/v1','middleware' => 'auth'], function() use($router)
{

    $router->get('/test', 'ExampleController@testMethod');

    //Route for GpsController
    $router->get('/locations', 'GpsController@index');
    $router->post('/location', 'GpsController@create');
    $router->get('/location/{id}', 'GpsController@show');
    $router->put('/location/{id}', 'GpsController@update');
    $router->delete('/location/{id}', 'GpsController@destroy');

    //Route for Order
    $router->get('/order/{id}', 'OrderController@show');

});
