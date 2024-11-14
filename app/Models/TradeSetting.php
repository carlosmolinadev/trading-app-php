<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeSetting extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'risk_reward', 'retry_attempt', 'skip_attempt', 'risked_amount', 'candle_close_trigger'];
}
