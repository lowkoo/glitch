<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

    require('C:/xam/htdocs/KOOsHUB/vendor/autoload.php');
    require('C:/xam/htdocs/KOOsHUB/model/functions/Chat.php');

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8080
    );

    $server->run();
    // C://xam/htdocs/KOOsHUB/model/bin/chat-server.php
