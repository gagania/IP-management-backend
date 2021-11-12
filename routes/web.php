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

//Generate Application key
// $router->get('/key',function(){
//     return Str::random(32);
// });

$router->post('/register','AuthController@register');
$router->post('/login','AuthController@login');
$router->get('/user','UserController@index');
$router->get('/user/{id}','UserController@show');

//IP Address
$router->get('ip/', 'IpController@index');
$router->get('ip/{id}/', 'IpController@show');
$router->post('/ip','IpController@create');
$router->put('ip/{id}/', 'IpController@update');

//Audit Trails
$router->get('audit_trails/', 'AuditTrailsController@index');
$router->get('audit_trails/{id}/', 'AuditTrailsController@show');