# Websockets examples of use

## Run on Dev

- GET route for start WSL listener: http://phpqa.local/chat/start
- in docker compose environment all needed ports must be accessible, example:

```
    ports:
        - "8083:8083"
```
- Для тестирования необходимо убедиться в наличии nginx под-конфига тут
  - \\wsl$\Ubuntu-22.04\etc\nginx\sites-available\phpqa.local.conf
```
server {
  listen 8083;
  location / {
    proxy_pass http://phpqa-nginx:8085;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
  }
}
```

- затем перейти по адресу: http://phpqa.local:8083/luap
- получить ответ ``` Hello world from Lua  <<phpqa-nginx:8085>> container! ```

## chat_ratchet

#### Installation Package to laravel

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

### Use case example (Windows platform):

- edit CHAT_* params in .env file
  server and client ports must be same.
  Ideal for both - 8083.
  Client scheme must be "ws"
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

#### Sources

- https://www.nginx.com/blog/websocket-nginx/
- https://code-boxx.com/php-live-chat-websocket/
