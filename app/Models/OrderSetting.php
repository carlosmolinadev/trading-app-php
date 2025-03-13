<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @param string $type
 * @param int $value
 * @param string $category
 * @param int $trade_setting_id
 * @return \App\Models\OrderSetting
 */
class OrderSetting extends Model
{
    use HasFactory;

    protected $table = 'order_setting';

    protected $fillable = [
        'type',
        'value',
        'category',
        'trade_setting_id',
    ];
}
