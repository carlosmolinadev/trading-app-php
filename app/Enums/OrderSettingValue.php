<?php

namespace App\Enums;

enum OrderSettingValue: string
{
    case LowCandle  = 'Low Candle';
    case MiddleCandle = 'Middle Candle';
    case HighCandle = 'High Candle';
    case Wick = 'Wick';
    case Candle = 'Open Candle Market';
    case StopLossRatio = 'Stop Loss Ratio';
}
