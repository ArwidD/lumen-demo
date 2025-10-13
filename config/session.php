<?php

return [
    'driver' => env('SESSION_DRIVER', 'file'),
    'lifetime' => env('SESSION_LIFETIME', 10),
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/session'),
    'cookie' => env('SESSION_COOKIE', 'lumen_session'),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', null),
    'secure' => false,
    'http_only' => true,
    'same_site' => null,
    'lottery' => [2, 100],
];