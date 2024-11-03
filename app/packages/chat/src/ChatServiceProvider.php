<?php

declare(strict_types=1);

namespace Dionisvl\Chat;

use Dionisvl\Chat\resources\views\Components\ChatBox;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->packageDir() . '/src/config/chat.php',
            'chat'
        );
    }

    protected function packageDir(): string
    {
        return dirname(__DIR__) . '/';
    }

    public function boot(): void
    {
        $this->commands([
            Console\Commands\RunChatServer::class,
        ]);
        $this->loadRoutesFrom($this->packageDir() . '/routes.php');
        $this->loadViewsFrom($this->packageDir() . '/src/resources/views', 'chat');
        //dd(config('chat.colors'));
        Blade::component('package-chat-box', ChatBox::class);
    }
}
