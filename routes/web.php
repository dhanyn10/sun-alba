<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/users', [ 'uses' => 'UserController@getAll']);
$router->get('/categories', [ 'uses' => 'CategoryController@getAll']);
$router->post('/register', [ 'uses' => 'UserController@register']);
$router->post('/login', [ 'uses' => 'UserController@login']);
$router->post('/logout', [ 'uses' => 'UserController@logout']);