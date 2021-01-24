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

https://code-boxx.com/php-live-chat-websocket/

run server:

```
php -q C:\OSpanel\domains\test\websockets\chat_ratchet\2-chat-server.php
```

Open url:  
http://test/websockets/chat_ratchet/3a-chat-client.php
