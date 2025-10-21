<?php

/** @var\Laravel\Lumen\Routing $router */

$router->get('/ping', function() {
    return response()->json(['pong'=>true]);
});

$router->get('/todo', 'TodoApiController@all');