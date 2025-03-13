<?php

namespace App\Enums;

enum Derivate: string
{
    case Spot  = 'Spot';
    case Futures = 'Futures';
    case Coin = 'Coin';
}
