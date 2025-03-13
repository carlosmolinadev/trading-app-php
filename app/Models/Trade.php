<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Trade
 *
 * @property int $id
 * @property string $symbol
 * @property string $derivate
 * @property int $trade_status_id
 * @property string|null $trade_setting_id
 * @property int $exchange_id
 * @property int $user_id
 * @property float $quantity
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 */
class Trade extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'trade';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'symbol',
        'derivate',
        'trade_status',
        'trade_setting_id',
        'exchange_id',
        'quantity',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @var bool
     */
    public $timestamps = true;

    public function orders(): HasMany
    {
        return $this->hasMany(TradeOrder::class);
    }
}
