<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', function () {
    return redirect()->route('blogview');
});

$router->get('blog', [
    'uses'  =>'PostController@blogViews',
    'as'    => 'blogview'
]);

$router->get('blog/{id}', [
    'uses'  =>'PostController@blogPosts',
    'as'    => 'blogposts'
]);

$router->get('/users', 'UserController@showAll');

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
    $router->post('', 'TagController@create');
    $router->put('{id}', 'TagController@update');
    $router->delete('{id}', 'TagController@delete');
});

$router->group([
    'middleware' => 'auth',
    'prefix' => 'posts'
], function () use ($router) {
    $router->get('','PostController@showAll');
    $router->post('', 'PostController@create');
    $router->put('{id}', 'PostController@update');
    $router->delete('{id}', 'PostController@delete');
});

$router->group([
    'middleware' => 'auth',
    'prefix' => 'shipping'
], function () use ($router) {

    $router->get('/', function () {
        return redirect()->route('province');
    });
    $router->get('province', [
        'uses' => 'ShippingController@dataProvinsi',
        'as' => 'province'
    ]);

    $router->get('city/{id}', 'ShippingController@dataKota');
    $router->post('cost', 'ShippingController@cost');
});

$router->post('/register','UserController@register');
$router->post('/login', 'UserController@login');
$router->post('/logout', 'UserController@logout');