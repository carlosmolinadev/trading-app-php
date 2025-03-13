<?php

namespace App\Providers;

use App\Contracts\ITradeService;
use App\Jobs\BinanceMarketDataProvider;
use App\Listeners\BinanceMarketData;
use App\Services\WebsocketService;
use App\Services\TradeService;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BinanceMarketData::class, function ()
        {
            return new BinanceMarketData();
        });
        $this->app->bind(ITradeService::class, TradeService::class);
        $this->app->singleton(WebsocketService::class, function ()
        {
            return new WebsocketService('usdt');
        });
        // $this->app->singleton(CreateOrder::class, function ()
        // {
        //     return new CreateOrder();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
