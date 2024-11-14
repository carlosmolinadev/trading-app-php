<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Ratchet\Client\WebSocket;
use React\EventLoop\Loop;

class BinanceMarketDataProvider implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle($event): void
    {
        $loop = Loop::get();
        $reactConnector = new \React\Socket\Connector();
        $connector = new \Ratchet\Client\Connector($loop, $reactConnector);
        $requestParameter = $event->symbol . '@kline_' . $event->interval;
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
                $data = json_encode([
                    "method" => "SUBSCRIBE",
                    "params" => [
                        $requestParameter
                    ],
                    "id" => 1
                ]);
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
