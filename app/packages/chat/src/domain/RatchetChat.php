<?php

namespace Dionisvl\Chat\domain;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Wkhooy\ObsceneCensorRus;

// (C) CHAT CLASS
class RatchetChat implements MessageComponentInterface
{
    // (C1) PROPERTIES
    protected $clients; // Debug mode
    private $debug = true; // Connect clients

    // (C2) CONSTRUCTOR - INIT LIST OF CLIENTS

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        if ($this->debug) {
            echo "Chat server started.\r\n";
        }
    }

    // (C3) ON CLIENT CONNECT - STORE INTO $THIS->CLIENTS
    public function onOpen(ConnectionInterface $conn): void
    {
        $this->clients->attach($conn);
        if ($this->debug) {
            echo "Client connected: {$conn->resourceId}\r\n";
        }
    }

    // (C4) ON CLIENT DISCONNECT - REMOVE FROM $THIS->CLIENTS
    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
        if ($this->debug) {
            echo "Client disconnected: {$conn->resourceId}\r\n";
        }
    }

    // (C5) ON ERROR
    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        $conn->close();
        if ($this->debug) {
            echo "Client error: {$conn->resourceId} | {$e->getMessage()}\r\n";
        }
    }

    // (C6) ON RECEIVING MESSAGE FROM CLIENT - SEND TO EVERYONE
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        if ($this->debug) {
            echo "Received message from {$from->resourceId}: {$msg}\r\n";
        }

        $msg = json_decode($msg, true, 512, JSON_THROW_ON_ERROR);
        $msg['datetime'] = date('Y-m-d H:i:s');
        ObsceneCensorRus::filterText($msg['m']);
        $msg = json_encode($msg, JSON_THROW_ON_ERROR);

        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }
}
