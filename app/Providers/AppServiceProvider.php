<?php

namespace App\Providers;

use App\Contracts\ITradeService;
use App\Events\TradeOrderCreated;
use App\Jobs\BinanceWorker;
use App\Listeners\BinanceMarketData;
use App\Listeners\CreateOrder;
use App\Services\BinanceWebSocketService;
use App\Services\TradeService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Event;
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
        $this->app->singleton(BinanceWebSocketService::class, function ()
        {
            return new BinanceWebSocketService('usdt');
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
