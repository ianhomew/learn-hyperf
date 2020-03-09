<?php


namespace App\Controller;


use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Websocket\Frame;
use Swoole\Server;
use Swoole\WebSocket\Server as WebSocketServer;

class UserController implements OnMessageInterface, OnCloseInterface, OnOpenInterface
{

    public function onMessage(WebSocketServer $server, Frame $frame): void
    {
        foreach ($server->connections as $connection) {
            $server->push($connection, $frame->data);
        }
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {

    }

    public function onOpen(WebSocketServer $server, Request $request): void
    {

    }
}