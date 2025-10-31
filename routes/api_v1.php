<?php

/** @var\Laravel\Lumen\Routing $router */

$router->get('/ping', function() {
    return response()->json(['pong'=>true]);
});

$router->get('/todo', 'TodoApiController@all');
$router->get('/todo/{id}','TodoApiController@get');
$router->post('/todo','TodoApiController@add');
$router->put('/todo/{id}','TodoApiController@update');
$router->patch('/todo/{id}','TodoApiController@check');
$router->delete('/todo','TodoApiController@remove');

//användare
$router->get('/anvandare', 'UserApiController@all');
$router->post('/anvandare', 'UserApiController@add');
$router->get('/anvandare/{id}', 'UserApiController@get');
$router->put('/anvandare/{id}', 'UserApiController@update');
$router->delete('/anvandare', 'UserApiController@remove');

//Login och refresh
$router->post('/login', 'AuthenticationController@login');
$router->get('/refresh', 'AuthenticationController@refresh');
$router->delete('/refresh', 'AuthenticationController@logout');