<?php
error_reporting(0); // Turn off all error reporting
ini_set('display_errors', 0);
// chat-server.php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require(__DIR__ . '/../vendor/autoload.php');
// require(__DIR__ ."/config.php");

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $conn;

    public function __construct() {
        $this->clients = new \SplObjectStorage;

        // DB connection
        $this->mysqli = new mysqli("127.0.0.1", "root", "", "ebarber");
        if ($this->mysqli->connect_error) {
            die("DB Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (!$data) {
            echo "Invalid JSON received\n";
            return;
        }

        // Save to DB
        $stmt = $this->mysqli->prepare("INSERT INTO messages (sender_email, receiver_email, compose, subject, name, date) VALUES (?, ?, ?, '', '', NOW())");
        if ($stmt) {
            $stmt->bind_param("sss", $data['sender'], $data['receiver'], $data['message']);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "DB statement error: " . $this->mysqli->error . "\n";
        }

        // Prepare broadcast message with status & timestamp
        $broadcast = json_encode([
            'sender'    => $data['sender'],
            'receiver'  => $data['receiver'],
            'message'   => htmlspecialchars($data['message']),
            'is_sender' => false, // We fix this below per client
            'status'    => 'Sent',
            'timestamp' => date('M j, Y h:i A'),
        ]);

        // Broadcast message to all clients
        foreach ($this->clients as $client) {
            // Mark is_sender true if client matches sender (we need client info to do this, assume no for simplicity)
            $client->send($broadcast);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Run server
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);

echo "WebSocket server started on ws://localhost:8080\n";

$server->run();
