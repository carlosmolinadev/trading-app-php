<?php

namespace App\Listeners;

use App\Events\BinanceMarketDataRequested;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Ratchet\Client\WebSocket;
use React\EventLoop\Loop;

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

    public function handleMarketDataRequest(BinanceMarketDataRequested $event)
    {
        $loop = Loop::get();
        $reactConnector = new \React\Socket\Connector();
        $connector = new \Ratchet\Client\Connector($loop, $reactConnector);
        $requestParameter = $event->symbol . '@kline_' . $event->interval;
        if (!in_array($event->symbol, $this->symbolList))
        {
            $this->symbolList[] = $event->symbol;
        }
        $endpoint = "wss://stream.binance.com:9443/ws";
        // $endpoint = "wss://stream.binance.com:9443/ws/{$event->symbol}@kline_{$event->interval}";
        $connector->__invoke($endpoint)->then(
            function (WebSocket $conn) use ($requestParameter)
            {
                $conn->on('message', function (\Ratchet\RFC6455\Messaging\MessageInterface $msg) use ($conn)
                {
                    echo "Received: {$msg}\n";
                    // $conn->close();
                });

                $conn->on('close', function ($code = null, $reason = null)
                {
                    echo "Connection closed ({$code} - {$reason})\n";
                });
                if ($this->connected)
                {
                    $data = json_encode([
                        "method" => "UNSUBSCRIBE",
                        "params" => [
                            $requestParameter
                        ],
                        "id" => 1
                    ]);
                    $conn->send($data);
                    $this->connected = false;
                }
                $data = json_encode([
                    "method" => "SUBSCRIBE",
                    "params" => [
                        $requestParameter
                    ],
                    "id" => 1
                ]);

                $var = $conn;

                $conn->send($data);
            },
            function (\Exception $e) use ($loop)
            {
                echo "Could not connect: {$e->getMessage()}\n";
                $loop->stop();
            }
        );
    }
}
