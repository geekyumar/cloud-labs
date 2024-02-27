<?php

class SocketServer
{
    private $socket;

    public function __construct($host, $port)
    {
        $this->socket = stream_socket_server("tcp://$host:$port", $errno, $errstr);

        if (!$this->socket) {
            die("Error: $errstr ($errno)\n");
        }
    }

    public function acceptConnection()
    {
        return stream_socket_accept($this->socket);
    }

    public function executeCommand($command)
    {
        return shell_exec($command . ' 2>&1');
    }

    public function closeConnection($client)
    {
        fclose($client);
        fclose($this->socket);
    }
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$server = new SocketServer('127.0.0.1', 8080);
$client = $server->acceptConnection();

// Execute apt-get update command and send output to the client
$aptUpdateLog = $server->executeCommand('whoami');
fwrite($client, $aptUpdateLog);

// Close the client and server sockets
$server->closeConnection($client);
?>
