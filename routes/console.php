<?php

use App\Console\Commands\DataProviders;
use Illuminate\Foundation\Inspiring;
use App\Jobs\BinanceMarketDataProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function ()
// {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:data-providers')->everyTenSeconds()->runInBackground();
