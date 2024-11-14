<?php

namespace App\Services;

use App\Models\Trade;

class TradeManager
{
    private static $instance = null;
    private $trades = [];

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new TradeManager();
        }
        return self::$instance;
    }

    public function createTrade($price, $quantity)
    {
        // Create the trade in the database
    }

    public function updateTrade($tradeId, $newPrice, $newQuantity)
    {
        if (isset($this->trades[$tradeId]))
        {
            $trade = $this->trades[$tradeId];
            $trade->price = $newPrice;
            $trade->quantity = $newQuantity;
            $trade->save(); // Persist changes to the database
        }
    }

    public function processTradeUpdate($message)
    {
        $tradeData = json_decode($message);
        $currentPrice = $tradeData->price;

        // Example: Check each trade if it needs updating
        foreach ($this->trades as $trade)
        {
            if ($trade->is_active && $this->shouldUpdateTrade($trade, $currentPrice))
            {
                $this->updateTrade($trade->id, $currentPrice, $trade->quantity);
            }
        }
    }

    private function shouldUpdateTrade($trade, $currentPrice)
    {
        // Example condition for updating a trade
        return $currentPrice > $trade->price;
    }
}
