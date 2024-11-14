<?php

namespace App\Services;


class BinanceWebSocketService
{
    private $symbol;
    private $connector;
    public function __construct($symbol)
    {
        $this->symbol = $symbol;
    }
    /**
     * Method increments the counter 
     */
    protected $counter = 0;
    public function increment()
    {
        $this->counter++;
        return $this->counter;
    }

    public function defaultSymbol($symbol = '')
    {
        if (!empty($symbol))
        {
            $this->symbol = $symbol;
        }
        $this->symbol = 'btcusdt';
        return;
    }
}
