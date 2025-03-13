<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TradeOrder
 *
 * @property int $id
 * @property float $quantity
 * @property float $amount
 * @property string $side
 * @property float $stop_price
 * @property float $limit_price
 * @property int|null $parent_order
 * @property int $order_type_id
 * @property int $trade_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class TradeOrder extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'trade_order';

    /**
     * @var array
     */
    protected $fillable = [
        'quantity',
        'amount',
        'side',
        'stop_price',
        'limit_price',
        'parent_order',
        'order_type_id',
        'trade_id',
        'created_at',
        'updated_at',
    ];
}
