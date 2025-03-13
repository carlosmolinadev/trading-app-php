<?php

namespace App\Enums;


enum TradeSettingStop: int
{
    case AFTER_CANDLE_CLOSE = 1;
    case CANDLE_CLOSE_BODY = 2;
    case CANDLE_OPEN_BODY = 3;
    case CANDLE_HALF = 4;
    case CANDLE_WICK = 5;

    public static function getTradeSettingOpenMode(int $id): string
    {
        return match ($id)
        {
            1 => strtolower(self::AFTER_CANDLE_CLOSE->name),
            2 => strtolower(self::CANDLE_CLOSE_BODY->name),
            3 => strtolower(self::CANDLE_OPEN_BODY->name),
            4 => strtolower(self::CANDLE_WICK->name),
            5 => strtolower(self::CANDLE_HALF->name),
            default => throw new \Exception('Invalid trade setting mode'),
        };
    }
}
