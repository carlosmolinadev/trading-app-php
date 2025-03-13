<?php

namespace App\Jobs;

use WebSocket\Client;
use WebSocket\Connection;
use WebSocket\Message\Binary;
use WebSocket\Message\Message;
use Illuminate\Support\Facades\DB;
use WebSocket\Middleware\CloseHandler;
use WebSocket\Middleware\PingResponder;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class BinanceMarketDataProvider implements ShouldQueue, ShouldBeUnique
{
    use Queueable;
    /**
     * Create a new job instance.
     */
    public function __construct(string $queueName)
    {
        $this->onQueue($queueName);
    }

    public function subscribeToSymbolMarket(string $symbol, string $interval): bool
    {
        $requestParameter = $symbol . '@kline_' . $interval;
        $data = json_encode([
            "method" => "SUBSCRIBE",
            "params" => [
                $requestParameter
            ],
            "id" => 1
        ]);
        if (!isset($this->connection))
        {
            return false;
        }
        return true;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $collection = collect([1, 2, 3, 4, 5]);
        sleep(2);
        // $payload = DB::table('data_provider')->where('name', 'account_provider')->get();
        DB::insert('INSERT INTO data_provider (name, payload, exchange, running) VALUES (?, ?, ?, ?)', ['account_provider', $collection->random(), 'binance', true]);
        $payload = DB::table('data_provider')->where('name', 'account_provider')->get();
        return;

        $method = $payload->method;
        $endpoint = "wss://fstream.binance.com/ws/btcusdt@kline_1m";
        $client = new Client($endpoint);
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
