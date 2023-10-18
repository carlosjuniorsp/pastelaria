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

/**
 * Customer Route Group the clients
 */
$router->group(['prefix' => '/api/clients'], function () use ($router) {
    $router->get("/", "ClientsController@index");
    $router->get("/{id}", "ClientsController@show");
    $router->post("/", "ClientsController@store");
    $router->put("{id}", "ClientsController@update");
    $router->delete("{id}", "ClientsController@destroy");
});


/**
 * Customer Route Group the products
 */
$router->group(['prefix' => '/api/products'], function () use ($router) {
    $router->get("/", "ProductsController@index");
    $router->get("/{id}", "ProductsController@show");
    $router->post("/", "ProductsController@store");
    $router->put("{id}", "ProductsController@update");
    $router->delete("{id}", "ProductsController@destroy");
});


/**
 * Customer Route Group the order
 */
$router->group(['prefix' => '/api/order'], function () use ($router) {
    $router->get("/", "OrderController@index");
    $router->get("/{id}", "OrderController@show");
    $router->post("/", "OrderController@store");
    $router->put("{id}", "OrderController@update");
    $router->delete("{id}", "OrderController@destroy");
});