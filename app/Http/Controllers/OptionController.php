<?php

namespace App\Http\Controllers;

use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Services\TradeService;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function __construct(protected TradeService $tradeService)
    {
    }

    public function symbol(Request $request)
    {
        $optionName = 'symbol';
        $options = Symbol::where('exchange_id', $request->query('exchange_id'))->get();
        return view('fragments.select-option', compact('optionName', 'options'));
    }
}
