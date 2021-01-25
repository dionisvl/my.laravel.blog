<?php

namespace Dionisvl\Chat\Console\Commands;

use Dionisvl\Chat\domain\RatchetChat;
use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

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
        if (PHP_SAPI !== "cli") {
            die("Please run this in the command line");
        }

        // WEBSOCKET SERVER START!
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new RatchetChat()
                )
            ), config('chat.proxy_side.port')
        );
        $server->run();
        return 0;
    }
}
