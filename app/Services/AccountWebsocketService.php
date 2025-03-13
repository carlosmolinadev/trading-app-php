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
    protected string $type;
    protected int $exchangeId;
    protected string $method;
    public function __construct(string $name, int $exchangeId, string $type, string $method)
    {
        $this->type = $type;
        $this->exchangeId = $exchangeId;
        $this->method = $method;
        $this->onQueue($name);
    }

    public function handle()
    {
        $listenKey = "";
        $payload = DB::table('data_provider')->where('name', 'account_provider')->get();
        if ($this->type == 'account_provider')
        {
            $listenKey = $payload->listen_key;
        }
        else
        {
        }
        $client = new Client($payload->exchange_url);
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
