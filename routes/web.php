<?php

use App\Services\TradeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Process;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Concurrency;
use App\Http\Controllers\TradeSettingController;
use App\Jobs\BinanceMarketDataProvider;

Route::get('/', function ()
{
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/xsrf', function (TradeService $service)
{
    $token = csrf_token();
    $queueName = 'testQueue';

    // $result = null;
    $result = Process::path('/projects/trading-app')->start('bash queue.sh ' . $queueName);
    BinanceMarketDataProvider::dispatch('testQueue');

    // while ($result == null)
    // {
    //     $result = $process->latestOutput();
    //     sleep(1);
    // }

    // $result = $process->wait();
    // Concurrency::defer([
    //     fn() => $service->handle()
    // ]);
    // BinanceAccountDataProvider::dispatch(1);
    return response()->json(['token' => $token]);
});

Route::controller(OptionController::class)->group(function ()
{
    Route::get('/option', 'symbol')->name('option.symbol');
});

Route::post('trade-setting/toggle-order', [TradeSettingController::class, 'toggleOrder']);

Route::resource('trade-setting', TradeSettingController::class);
Route::resource('trade', TradeController::class)->middleware('auth');
Route::resource('settings', SettingController::class)->middleware('auth');

// Route::controller(TradeController::class)->group(function ()
// {
//     Route::get('/trade', 'index')->name('trade.index');
//     Route::post('/trade', 'create')->name('trade.create');
//     Route::get('/trade/setting', 'indexTradeSetting')->name('trade.index.setting');
//     Route::post('/trade/setting', 'createTradeSetting')->name('trade.create.setting');
// });

// Route::controller(SettingController::class)->group(function ()
// {
//     Route::get('/setting', 'index')->name('setting.index');
//     Route::get('/setting', 'get')->name('setting.get');
//     Route::post('/setting', 'create')->name('setting.create');
//     Route::get('/setting/{id}/exchange/{exchange}', 'showApiKey')->name('setting.show.apikey');
//     Route::post('/setting/apikey', 'storeApiKey')->name('setting.store.apikey');
// });

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
