<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\TradeSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TradeService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Trade\TradeSettingRequest;

class TradeSettingController extends Controller
{
    public function __construct(TradeService $tradeService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tradeSettings = TradeSetting::where('user_id', Auth::id());
        return view('trade.setting.index', compact('tradeSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data['openOrderOptions'] = ['Low Candle', 'Middle Candle', 'High Candle', 'Wick'];
        $data['stopLossOptions'] = ['Candle', 'Wick'];
        $data['takeProfitOptions'] = ['Stop Loss Ratio'];

        return view('trade-setting.create', ['data' => $data]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TradeSettingRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        redirect(route('trade-setting.index'))->with('success', 'Trade setting created successfully.');
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

    public function toggleOrder(Request $request)
    {
        $data = [];
        if ($request->has('open_order_setting_checkbox'))
        {
            $data['openOrderSetting'] = !$request->input('open_order_setting_checkbox');
            $data['orderSettings'][] = ['open_order_setting' => ['Low Candle', 'Middle Candle', 'High Candle', 'Wick']];
        }
        if ($request->has('stop_loss_setting_checkbox'))
        {
            $data['stopLossSetting'] = !$request->input('open_order_setting_checkbox');
            $data['orderSettings'][] = ['stop_loss_setting' => ['Candle', 'Wick']];
        }
        return view('trade-setting.fragments.toggle-order', ['data' => $data]);
    }
}
