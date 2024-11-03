<?php

return [
    'proxy_side' => [
        'port' => env('CHAT_PROXY_SIDE_PORT', '8080'),
    ],

    'client_side' => [
        'scheme' => env('CHAT_CLIENT_SIDE_SCHEME', 'ws'),
        'host' => env('CHAT_CLIENT_SIDE_HOST', 'localhost'),
        'port' => env('CHAT_CLIENT_SIDE_PORT', '80'),
        'route' => env('CHAT_CLIENT_SIDE_ROUTE', 'ws'),
    ],

    'colors' => ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00']
];
