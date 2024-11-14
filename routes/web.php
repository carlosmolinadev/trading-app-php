<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TradeSettingController;

Route::get('/', function ()
{
    return view('welcome');
})->middleware('auth');

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/xsrf', function ()
{
    $token = csrf_token();
    return response()->json(['token' => $token]);
});

Route::resource('trade-setting', TradeSettingController::class);
Route::resource('trade', TradeController::class)->middleware('auth');

// Route::controller(TradeController::class)->group(function ()
// {
//     Route::get('/trade', 'index')->name('trade.index');
//     Route::post('/trade', 'create')->name('trade.create');
//     Route::get('/trade/setting', 'indexTradeSetting')->name('trade.index.setting');
//     Route::post('/trade/setting', 'createTradeSetting')->name('trade.create.setting');
// });

Route::controller(SettingController::class)->group(function ()
{
    Route::get('/setting', 'index')->name('setting.index');
    Route::get('/setting', 'get')->name('setting.get');
    Route::post('/setting', 'create')->name('setting.create');
    Route::get('/setting/{id}/exchange/{exchange}', 'showApiKey')->name('setting.show.apikey');
    Route::post('/setting/apikey', 'storeApiKey')->name('setting.store.apikey');
});

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
