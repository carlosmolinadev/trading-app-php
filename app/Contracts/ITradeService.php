<?php

namespace App\Contracts;

use App\DTOs\ApiKeyDto;
use App\Dtos\TradeSettingDto;
use App\Http\Requests\Trade\ApiKeyRequest;
use App\Http\Requests\Trade\TradeSettingRequest;

interface ITradeService
{
    /**
     * Get the API key for a specific user and exchange.
     *
     * @param int $userId
     * @param string $exchange
     * @return ApiKeyDto[]
     */
    public function getApikey(int $userId, array $query): array;

    /**
     * Create apikey for user.
     *
     * @param ApiKeyDto $apikey
     * @return bool
     */
    public function createApikey(ApiKeyRequest $apikey): bool;

    /**
     * Get the trade settings for a user.
     *
     * @param int $userId
     * @return TradeSettingDto[]
     */
    public function getTradeSetting(int $userId): array;

    /**
     * Create trade settings for a user.
     *
     * @param TradeSettingDto $setting
     * @return bool
     */
    public function createTradeSetting(TradeSettingRequest $setting): bool;

    public function createTrade(): bool;
}
