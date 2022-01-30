# Websockets examples of use

## chat_ratchet

#### installation

add to config/app.php in 'providers' section:

```
Dionisvl\Chat\ChatServiceProvider::class,
```

add to composer.json to "autoload - psr-4" section:

```
"Dionisvl\\Chat\\": "packages/chat/src/"
```

run command:

```
composer dump
```

### Start server

```
php artisan chat:start
```

## How to make nginx proxy for websockets

```
    location /wss/ {
        proxy_pass http://localhost:8080;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
```

source:  
https://code-boxx.com/php-live-chat-websocket/

Use case example (Windows platform):

- edit CHAT_* params in .env file  
  server and client ports must be same. Ideal for both - 8083  
  client scheme must be "ws"
- run server :

```
php artisan chat:start
or
php -q C:\OSpanel\domains\test\websockets\chat_ratchet\2-chat-server.php
```

- Open url:  
  http://test/websockets/chat_ratchet/3a-chat-client.php

##### A specific table fresh migration:
```
php artisan migrate:refresh --path=\packages\chat\src\database\migrations\2021_08_15_150822_create_chat_users_table.php
php artisan migrate:refresh --path=\packages\chat\src\database\migrations\2021_08_15_150823_create_chat_messages_table.php
```