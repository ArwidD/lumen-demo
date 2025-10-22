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