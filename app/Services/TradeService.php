<?php

namespace App\Services;

use App\DTOs\ApiKeyDto;
use App\Contracts\ITradeService;
use App\Http\Requests\Trade\ApiKeyRequest;
use App\Http\Requests\Trade\TradeRequest;
use App\Http\Requests\Trade\TradeSettingRequest;
use App\Models\ApiKey;
use App\Models\Trade;
use App\Models\TradeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TradeService
{
    public function getTradeSetting(int $userId): array
    {
        try
        {
            $resultSet = DB::select(
                'select * from trade_settings where user_id = ?',
                [$userId]
            );
            return $resultSet;
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
            $trade = new Trade;
            $trade->symbol = $request['symbol'];
            // $trade->derivate = $request['derivate'];
            // $trade->side = $request['side'];
            $trade->exchange_id = $request['exchange_id'];
            $trade->user_id = $request['user_id'];
            $trade->save();
            $tradeId = $trade->id;
            return true;
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }
    public function createTradeSetting(TradeSettingRequest $setting): bool
    {
        try
        {
            return DB::insert(
                'insert into trade_settings(user_id, name, retry_attempt, skip_attempt, candle_close_trigger, risk_amount_trade, stop_loss_wick_count_close, stop_loss_wick_close, trade_id) values (?,?,?,?,?,?,?,?,?,?)',
                [
                    $setting->userId,
                    $setting->name,
                    $setting->retryAttempt,
                    $setting->skipAttempt,
                    $setting->candleCloseTrigger,
                    $setting->riskAmountTrade,
                    $setting->stopLossWickCountClose,
                    $setting->stopLossWickClose,
                    $setting->tradeId
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
}
