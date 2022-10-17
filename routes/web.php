<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/users', [ 'uses' => 'UserController@showAll']);

$router->get('/categories', [ 'uses' => 'CategoryController@showAll']);
$router->post('/categories', [ 'uses' => 'CategoryController@create']);
$router->put('/categories/{id}', 'CategoryController@update');

$router->post('/register', [ 'uses' => 'UserController@register']);
$router->post('/login', [ 'uses' => 'UserController@login']);
$router->post('/logout', [ 'uses' => 'UserController@logout']);