<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'platform', 'as' => 'platform'], function () use ($router) {
    $router->get('/', [
        'as' => 'index', 'uses' => 'PlatformController@index'
    ]);
    $router->post('add', [
        'as' => 'add', 'uses' => 'PlatformController@addPlatform'
    ]);
});
