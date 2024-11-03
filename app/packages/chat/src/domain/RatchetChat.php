<?php

declare(strict_types=1);

namespace Dionisvl\Chat\domain;

use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Wkhooy\ObsceneCensorRus;
use Exception;
use SplObjectStorage;

// (C) CHAT CLASS
class RatchetChat implements MessageComponentInterface
{
    // (C1) PROPERTIES
    protected $clients; // Debug mode
    private $debug = true; // Connect clients

    // (C2) CONSTRUCTOR - INIT LIST OF CLIENTS

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
        if ($this->debug) {
            $msg = "Chat server started.\r\n";
            echo $msg;
            Log::debug($msg);
        }
    }

    // (C3) ON CLIENT CONNECT - STORE INTO $THIS->CLIENTS
    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        if ($this->debug) {
            $msg = "Client connected: {$conn->resourceId}\r\n";
            echo $msg;
            Log::debug($msg);
        }
    }

    // (C4) ON CLIENT DISCONNECT - REMOVE FROM $THIS->CLIENTS
    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
        if ($this->debug) {
            $msg = "Client disconnected: {$conn->resourceId}\r\n";
            echo $msg;
            Log::debug($msg);
        }
    }

    // (C5) ON ERROR
    public function onError(ConnectionInterface $conn, Exception $e): void
    {
        $conn->close();
        if ($this->debug) {
            $msg = "Client error: {$conn->resourceId} | {$e->getMessage()} | {$e->getTraceAsString()}\r\n";
            echo $msg;
            Log::debug($msg);
        }
    }

    // (C6) ON RECEIVING MESSAGE FROM CLIENT - SEND TO EVERYONE
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        $msg = json_decode(stripslashes($msg), true, 512, JSON_THROW_ON_ERROR);

        if ($this->debug) {
            $logMsg = "Received message from {$from->resourceId}: {$msg['m']}\r\n";
            //            echo $logMsg;
            Log::debug($logMsg);
        }

        $msg['datetime'] = date('Y-m-d H:i:s');
        ObsceneCensorRus::filterText($msg['m']);
        $msg = json_encode($msg, JSON_THROW_ON_ERROR);

        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
}
