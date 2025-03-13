<?php

namespace App\Enums;


enum TradeSettingOpen: int
{
    case AFTER_CANDLE_CLOSE = 1;
    case CANDLE_OPEN_BODY = 2;
    case CANDLE_HALF = 3;
    case CANDLE_WICK = 4;

    public static function getTradeSettingOpenMode(int $id): string
    {
        return match ($id)
        {
            1 => strtolower(self::AFTER_CANDLE_CLOSE->name),
            2 => strtolower(self::CANDLE_OPEN_BODY->name),
            3 => strtolower(self::CANDLE_WICK->name),
            4 => strtolower(self::CANDLE_HALF->name),
            default => throw new \Exception('Invalid trade setting mode'),
        };
    }
}
