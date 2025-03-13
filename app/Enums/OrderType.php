<?php

namespace App\Enums;

enum OrderType: int
{
    case Limit = 1;
    case Market = 2;
    case Stop = 3;
    case TakeProfit = 4;
    case StopLimit = 5;

    /**
     * Get the integer value of the order type from its name.
     *
     * @param string $name The name of the order type.
     * 
     * @return int The integer value of the order type.
     */
    public static function fromName(string $name): int
    {
        foreach (self::cases() as $status)
        {
            if ($name === $status->name)
            {
                return $status->value;
            }
        }
    }
}
