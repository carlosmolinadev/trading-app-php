<?php

namespace App\Services;

use stdClass;
use App\Models\Trade;
use App\Models\ApiKey;
use App\DTOs\ApiKeyDto;
use App\Models\TradeOrder;
use App\Models\TradeSetting;
use App\Contracts\ITradeService;
use App\Enums\OrderType;
use App\Enums\TradeStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Trade\TradeRequest;
use App\Http\Requests\Trade\ApiKeyRequest;
use App\Http\Requests\Trade\TradeSettingRequest;
use ReflectionEnum;

class TradeService
{
    public function getTradeSetting(int $userId)
    {
        try
        {
            $test = DB::table('trade_settings')->where('user_id', $userId)->get();
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updateTradeSetting(TradeSettingRequest $setting): bool
    {
        try
        {
            return DB::update(
                'update trade_settings
                    set name = ?, 
                    retry_attempt = ?, 
                    skip_attempt = ?, 
                    candle_close_trigger = ?, 
                    risk_amount_trade = ?, 
                    stop_loss_wick_count_close = ?, 
                    stop_loss_wick_close = ? 
                where id = ?',
                [
                    $setting->name,
                    $setting->retryAttempt,
                    $setting->skipAttempt,
                    $setting->candleCloseTrigger,
                    $setting->riskAmountTrade,
                    $setting->stopLossWickCountClose,
                    $setting->stopLossWickClose,
                    $setting->id
                ]
            );
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Create a new trade using the provided trade settings.
     *
     * @param \App\Http\Requests\Trade\TradeRequest $request
     * @return bool
     */
    public function createTrade($request): bool
    {
        try
        {
            $orders = $request['orders'];
            $request['trade_status'] = TradeStatus::Created->value;

            return true;
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function createTradeSetting($data): bool
    {
        try
        {
            return DB::table('trade_setting')->insert([
                'name' => $data['name'],
                'retry_attempt' => $data['retry_attempt'],
                'skip_attempt' => $data['skip_attempt'],
                'risk_percentage' => $data['risk_percentage'],
                'open_trade_mode' => $data['open_trade_mode'],
                'open_trade_value' => $data['open_trade_value'],
                'stop_loss_mode' => $data['stop_loss_mode'],
                'stop_loss_value' => $data['stop_loss_value'],
                'created_at' => now()->toImmutable()->format('Y-m-d H:i:s'),
            ]);
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }
    /**
     * @param int $id
     * @return ApiKeyDto[]
     */
    public function getApiKey($id): array
    {
        try
        {
            $sql = 'select id, public, exchange_id from api_keys where 0=0 ';
            $where = '';
            if (isset($query))
            {
                foreach ($query as $key => $value)
                {
                    $where .= "and $key = $value ";
                }
            }
            // $exchangeId = DB::select('select id from exchange where name = ?', [$exchange]);
            // $resultSet = DB::select(
            //     'select * from api_keys where user_id = ? and exchange_id = ?',
            //     [$id, $exchangeId[0]->id]
            // );
            // return $resultSet[0];
            return [];
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param \App\Http\Requests\ApiKeyRequest $apikey
     * @return ApiKey 
     */
    public function createApiKey(ApiKeyRequest $apikey): bool
    {
        try
        {
            $exchange = DB::select('select id from exchange where name = ?', [$apikey->exchange]);
            ApiKey::create([
                'public' => $apikey->public,
                'private' => $apikey->private,
                'exchange_id' => $exchange[0]->id,
                'user_id' => $apikey->userId
            ]);
            return true;
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function createTradeOrder(int $tradeId): stdClass
    {
        try
        {
            $tradeOrder = DB::select('
                    select trade_id as tradeId, limit_price as limitPrice from trade t
                    inner join trade_order tor 
                        on tor.trade_id = t.id
                    where t.id = ?', [$tradeId]);
            return $tradeOrder[0];
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
        }
    }
}
