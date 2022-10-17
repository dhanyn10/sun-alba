<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/users', [ 'uses' => 'UserController@showAll']);

$router->group([
    'middleware' => 'auth',
    'prefix' => 'categories'
], function () use ($router) {
    $router->get('','CategoryController@showAll');
    $router->post('', 'CategoryController@create');
    $router->put('{id}', 'CategoryController@update');
    $router->delete('{id}', 'CategoryController@delete');
});

$router->group([
    'middleware' => 'auth',
    'prefix' => 'tags'
], function () use ($router) {
    $router->get('','TagController@showAll');
    // $router->post('', 'TagController@create');
    // $router->put('{id}', 'TagController@update');
    // $router->delete('{id}', 'TagController@delete');
});

$router->post('/register', [ 'uses' => 'UserController@register']);
$router->post('/login', [ 'uses' => 'UserController@login']);
$router->post('/logout', [ 'uses' => 'UserController@logout']);