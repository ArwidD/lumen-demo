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
    return view('welcome');
});
$router->get('/{id:(?!farger$)}', function ($id) use ($router) {
    return view('hello', ['namn' => $id]);
});

$router->get('/farger', 'ColorController@show');
$router->get('/farger/{back}/{front}', 'ColorController@withParams');
$router->post('/farger', 'ColorController@post');
