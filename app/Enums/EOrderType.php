<?php

namespace App\Enums;


enum EOrderType: string
{
    case LIMIT = 'limit';
    case MARKET = 'market';
    case STOP_LOSS = 'stop_loss';
    case TAKE_PROFIT = 'take_profit';
}
