<?php

namespace App\Enums;

enum TradeStatus: string
{
    case Created = 'created';
    case Active = 'active';
    case Pending = 'pending';
    case Updated = 'updated';
    case Finished = 'finished';
    case Canceled = 'canceled';
}
