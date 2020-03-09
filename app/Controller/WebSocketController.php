<?php


namespace App\Controller;


use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;

/**
 *
 * Class WebSocketController
 * @package App\Controller
 */
class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{

    public function onMessage(WebSocketServer $server, Frame $frame): void
    {
        echo 'Server Receive: ' . $frame->data . PHP_EOL;

        // 單發
//        $server->push($frame->fd, 'Recv: ' . $frame->data);

        // 群發
        foreach ($server->connections as $connection) {
            echo '$connection = ' . $connection . PHP_EOL;
            $server->push($connection, 'Recv: ' . $frame->data);
            $server->disconnect($connection);
        }

        //        $server->send()
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen(WebSocketServer $server, Request $request): void
    {
        $server->push($request->fd, 'Opened');
    }
}
