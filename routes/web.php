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

$router->get('/', function() use ($router) {
    return view('welcome');
});

// Hantering av färger på webbsidan
$router->get('/farger', 'ColorController@show');
$router->get('/farger/{back}[/{front}]', 'ColorController@withParams');
$router->post('/farger', 'ColorController@post');

// Todo!
$router->get('/todo', 'TodoController@show');
$router->post('/todo', 'TodoController@add');
$router->delete('/todo', 'TodoController@remove');
$router->put('/todo', 'TodoController@update');

// Användare
$router->group(['middleware' => 'auth.user'], function() use ($router) {
    $router->get('/anvandare', 'UserController@show');
    $router->get('/anvandare/{id}', 'UserController@showUser');
    $router->post('/anvandare/{id}', 'UserController@modifyUser');
    $router->post('/anvandare', 'UserController@add');
});

// Inloggning
$router->get('/login', 'LoginController@show');
$router->post('/login', 'LoginController@login');

// Registrering
$router->get('/register', 'RegisterController@show');
$router->post('/register', 'RegisterController@register');


// Fallback rutt
$router->get('/{id}', function($id) use ($router) {
    $reserved = ['todo', 'farger', 'anvandare'];
    if (in_array(strtolower($id), $reserved)) {
        return redirect('/' . strtolower($id));
    }
    return view('hello', ['namn' => $id]);
});