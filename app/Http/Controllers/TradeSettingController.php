<?php

namespace App\Http\Controllers;

use App\Models\TradeSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TradeSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Hello Wrodl';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('trade.partials.trade-setting');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $validated = $request->validate([
                'trade_id' => 'required',
                'name' => 'required|string|max:25',
                'risk_reward' => 'boolean',
                'retry_attempt' => 'nullable',
                'skip_attempt' => 'nullable',
                'candle_close_trigger' => 'boolean',
                'risked_amount' => 'required|min:0',
                'stop_loss_wick_close' => 'boolean',
                'secure_trade_profit' => 'boolean',
            ]);
            TradeSetting::create($validated);
            return $validated;
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TradeSetting $tradeSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TradeSetting $tradeSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TradeSetting $tradeSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TradeSetting $tradeSetting)
    {
        //
    }
}
