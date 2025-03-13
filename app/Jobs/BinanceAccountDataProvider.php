<?php

namespace App\Jobs;

use App\Enums\TradeStatus;
use React\EventLoop\Loop;
use Ratchet\Client\WebSocket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class BinanceAccountDataProvider implements ShouldQueue
{
    use Queueable;
    protected WebSocket $conn;

    /**
     * Create a new job instance.
     */
    public function __construct($number)
    {
    }

    public function subscribeToAccountUpdates(string $symbol, string $interval): bool
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
        $this->conn->send($data);
        return true;
    }

    protected function pendingTrades()
    {
        $pendingTrades = DB::select('
            select * from trade t
            inner join trade_order to on t.id = to.trade_id
            where status = :statusId
        ', ['statusId' => TradeStatus::PENDING]);
        if (empty($pendingTrades))
        {
            return [];
        }
        return $pendingTrades;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // $trades = $this->pendingTrades();
        // if (!empty($trades))
        // {
        // }
        $loop = Loop::get();
        $reactConnector = new \React\Socket\Connector();
        $connector = new \Ratchet\Client\Connector($loop, $reactConnector);
        // $requestParameter = $event->symbol . '@kline_' . $event->interval;
        $endpoint = "wss://stream.binance.com:9443/ws";
        // $endpoint = "wss://stream.binance.com:9443/ws/{$event->symbol}@kline_{$event->interval}";
        // $connector->__invoke($endpoint)->then(
        //     function (WebSocket $conn) use ($requestParameter)
        //     {
        //         $conn->on('message', function (\Ratchet\RFC6455\Messaging\MessageInterface $msg) use ($conn)
        //         {
        //             echo "Received: {$msg}\n";
        //         });

        //         $conn->on('close', function ($code = null, $reason = null)
        //         {
        //             echo "Connection closed ({$code} - {$reason})\n";
        //         });
        //         $this->connection = $conn;
        //     },
        //     function (\Exception $e) use ($loop)
        //     {
        //         echo "Could not connect: {$e->getMessage()}\n";
        //         $loop->stop();
        //     }
        // );
    }
}
