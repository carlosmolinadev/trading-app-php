<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Symbol;
use App\Enums\Derivate;
use Illuminate\Http\Request;
use App\Services\TradeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Trade\TradeRequest;
use App\Models\TradeSetting;

class TradeController extends Controller
{
    public function __construct(protected TradeService $tradeService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $userId = ;
        $test = Auth::id();
        $trades = Trade::where('user_id', Auth::id())->get();
        return view('trade.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exchanges = DB::select('select * from exchange');
        $derivates = Derivate::cases();
        $orderTypes = DB::select('select * from order_type');
        $tradeSettings = TradeSetting::where('user_id', Auth::id())->get();
        $symbols = [];
        if (old('exchange_id'))
        {
            $symbols = Symbol::where('exchange_id', old('exchange_id'))->get();
        }
        return view('trade.create', compact('exchanges', 'derivates', 'symbols', 'orderTypes', 'tradeSettings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TradeRequest $request)
    {
        $validated = $request->validated();
        unset($validated['orders']);
        // $validated['user_id'] = Auth::id();

        DB::table('trade')->insert($validated);

        $this->tradeService->createTrade($request->all());
        return redirect('trade.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trade $trade)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trade $trade)
    {
        //
    }
}
