<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('/register','AuthController@register');
// $router->post('/login','AuthController@login');
$router->get('/user','UserController@index');
$router->get('/user/{id}','UserController@show');
$router->get('/logout','UserController@logout');

$router->group(['prefix' => 'ip', 'middleware' => 'auth'], function() use (&$router){
    $router->get('/', 'IpController@index');
    $router->get('{id}/', 'IpController@show');
    $router->post('/','IpController@create');
    $router->put('{id}/', 'IpController@update');
});

$router->group(['prefix' => 'audit_trails', 'middleware' => 'auth'], function() use (&$router){
    $router->get('/', 'AuditTrailsController@index');
    $router->get('{id}/', 'AuditTrailsController@show');
});

$router->group(['prefix' => 'access_log', 'middleware' => 'auth'], function() use (&$router){
    $router->get('/', 'AccessLogController@index');
    $router->get('{id}/', 'AccessLogController@show');
    $router->post('/','AccessLogController@create');
});