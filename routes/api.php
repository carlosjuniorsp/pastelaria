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
 * Customer Route Group
 */
$router->group(['prefix' => '/api/clients'], function () use ($router) {
    $router->get("/", "ClientsController@index");
    $router->get("/{id}", "ClientsController@get");
    $router->post("/", "ClientsController@store");
    $router->put("{id}", "ClientsController@update");
    $router->delete("{id}", "ClientsController@destroy");
});
