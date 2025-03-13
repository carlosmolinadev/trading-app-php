<?php

namespace App\Listeners;

use WebSocket\Client;
use WebSocket\Connection;
use WebSocket\Message\Message;
use Illuminate\Support\Facades\DB;
use WebSocket\Middleware\CloseHandler;
use WebSocket\Middleware\PingResponder;
use App\Events\BinanceMarketDataRequested;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;

class BinanceMarketData implements ShouldQueue
{
    public $queue = 'binance-market-data';

    protected $symbolList = [];
    protected $connected = false;
    private static $connector = null;
    private static $counter = 1;

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            BinanceMarketDataRequested::class,
            [BinanceMarketData::class, 'handleMarketDataRequest']
        );
        // $events->listen(
        //     BinanceMarketDataRequested::class,
        //     [BinanceMarketData::class, 'handleMarketDataRequest']
        // );
    }
    /**
     * Get the name of the listener's queue.
     */
    public function viaQueue(): string
    {
        return 'binance-market-data';
    }

    protected function checkForUpdates()
    {
        DB::select('select * from market_data_update where exchange_id = 1');
    }

    public function handleMarketDataRequest()
    {
        $endpoint = "wss://stream.binance.com:9443/ws";
        $client = new Client($endpoint);
        $client
            ->addMiddleware(new CloseHandler())
            ->addMiddleware(new PingResponder())
            ->onText(function (Client $client, Connection $connection, Message $message)
            {
                // Act on incoming message
                echo "Got message: {$message->getContent()} \n";
                // Possibly respond to server
                // $client->text("I got your your message");
            })
            ->start();
    }
}
