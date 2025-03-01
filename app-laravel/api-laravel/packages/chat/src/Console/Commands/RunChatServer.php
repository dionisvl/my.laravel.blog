<?php

declare(strict_types=1);

namespace Dionisvl\Chat\Console\Commands;

use Dionisvl\Chat\domain\RatchetChat;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Throwable;

class RunChatServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start chat server or check if already running';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //        if (PHP_SAPI !== "cli") {
        //            die("Please run this in the command line");
        //        }


        try {
            Log::debug('try to start Chat. With "chat proxy side port" - ' . config('chat.proxy_side.port'));
            // WEBSOCKET SERVER START!
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new RatchetChat()
                    )
                ),
                config('chat.proxy_side.port')
            );
            Log::debug('chat started on address ' . $server->socket->getAddress());
            echo 'chat started on address: ' . $server->socket->getAddress();

            $server->run();
        } catch (Throwable $e) {
            Log::debug('exception during CHATTING: ' . $e->getMessage() . $e->getTraceAsString());
        }


        return 0;
    }
}
