<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BinanceMarketDataRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $symbol;
    public string $interval;
    /**
     * Create a new event instance.
     */
    public function __construct(string $symbol, string $interval)
    {
        $this->symbol = $symbol;
        $this->interval = $interval;
    }
}
