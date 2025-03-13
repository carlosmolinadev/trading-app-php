<?php

namespace App\Services;

use WebSocket\Client;
use WebSocket\Connection;
use WebSocket\Message\Message;
use Illuminate\Support\Facades\DB;
use WebSocket\Middleware\PingResponder;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;


class WebsocketService implements ShouldQueue
{
    use Queueable;
    protected string $method;
    protected int $exchangeId;
    protected string $exchange_url;
    public function __construct(int $exchangeId, string $exchange_url, string $method)
    {
        $this->method = $method;
        $this->exchangeId = $exchangeId;
        $this->exchange_url = $exchange_url;
        $this->onQueue($exchangeId);
    }

    public function handle()
    {
        $client = new Client($this->exchange_url . $this->method);
        $client
            ->addMiddleware(new PingResponder())
            ->onText(function (Client $client, Connection $connection, Message $message)
            {
                // Act on incoming message
                echo "Got message: {$message->getContent()} \n";
                // Possibly respond to server
                // $client->text("I got your your message");
            })
            ->onHandshake(function ()
            {
                echo "Handshake successful! \n";
            })
            ->onTick(function ()
            {
                echo "Ticking \n";
            })
            ->start();
    }
}
