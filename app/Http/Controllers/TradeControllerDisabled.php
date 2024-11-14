<?php

// namespace App\Http\Controllers;

// use App\Enums\ETradeSide;
// use Illuminate\View\View;
// use Illuminate\Support\Str;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use App\Services\TradeService;
// use Illuminate\Validation\Rule;
// use Illuminate\Http\JsonResponse;
// use App\Listeners\BinanceMarketData;
// use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\Trade\TradeRequest;
// use App\Services\BinanceWebSocketService;
// use App\Http\Requests\Trade\TradeSettingRequest;

// class TradeController extends Controller
// {
//     protected $tradeService;
//     protected $binanceWebSocket;
//     protected $binanceMarketData;
//     public function __construct(TradeService $tradeService, BinanceWebSocketService $binanceWebSocket, BinanceMarketData $binanceMarketData)
//     {
//         $this->tradeService = $tradeService;
//         $this->binanceWebSocket = $binanceWebSocket;
//         $this->binanceMarketData = $binanceMarketData;
//     }

//     public function indexApikey(Request $request): string
//     {
//         try
//         {
//             // Create a new Memcached instance
//             // $data = [
//             //     'name' => 'John Doe',
//             //     'email' => 'john@example.com',
//             //     'age' => [20, 30, 40],
//             // ];
//             // $pulled = Cache::pull('test');
//             // $data = cache('key');
//             // cache(["key" => "value"], 2);
//             // $json = response()->json(Cache::get('key'));
//             // // Cache::flush();
//             // Cache::put('key', $data, 1);
//             // Cache::increment('key.counter', 20);
//             // $counter = Cache::get('key.counter');
//             // Cache::put('key.anotherTest', 'questions');
//             // return $result->output();
//             // $this->binanceMarketData->testInstance();
//             // BinanceMarketDataRequested::dispatch('btcusdt', '1m');
//             // sleep(1);
//             // BinanceMarketDataRequested::dispatch('btcusdt', '1m');
//             // ->onQueue('binance-market-data');
//             // BinanceMarketDataRequested::dispatch('btcusdt', '1m');
//             // BinanceMarketDataProvider::dispatch();
//             // $this->binanceWebSocket->increment();
//             // $this->binanceWebSocket->increment();
//             // $this->binanceWebSocket->increment();
//             // $this->tradeService->createTrade();
//             // $this->tradeService->createTrade();
//             // UpdatedKlineData::dispatch(30);
//             // sleep(4);
//             // TradeOrderCreated::dispatch(20);
//             // $request->validate([
//             //     'exchange' => 'required|string',
//             // ]);

//             // $user = $request->user();
//             // if (!isset($user))
//             // {
//             //     return response()->json([
//             //         'message' => 'User not found',
//             //     ], Response::HTTP_NOT_FOUND);
//             // };
//             // $apiKey = $this->tradeService->getApikey($user->id, $request->exchange);
//             // if (!isset($apiKey))
//             // {
//             //     return response()->json([
//             //         'message' => 'Apikey not found',
//             //     ], Response::HTTP_NOT_FOUND);
//             // }
//             // return response()->json([$apiKey], Response::HTTP_OK);
//             return response()->json([], Response::HTTP_OK);
//         }
//         catch (\Exception $e)
//         {
//             return response()->json([
//                 'message' => 'Validation failed',
//                 'errors' => $e->getMessage(),
//             ], Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//     }

//     public function createTradeSetting(TradeSettingRequest $request): JsonResponse
//     {
//         try
//         {
//             $userId = Auth::id();
//             $validated = $request->validated();
//             if (!isset($user))
//             {
//                 return response()->json([
//                     'message' => 'User not found',
//                 ], Response::HTTP_NOT_FOUND);
//             };

//             $this->tradeService->createTradeSetting($request);

//             return response()->json([]);
//         }
//         catch (\Exception $e)
//         {
//             // Handle validation errors
//             return response()->json([
//                 'message' => 'Validation failed',
//                 'errors' => $e->getMessage(),
//             ], Response::HTTP_UNPROCESSABLE_ENTITY);
//         }
//     }

//     public function create(Request $request): View
//     {
//         $request->validate([
//             'symbol' => 'required',
//             'exchange_id' => 'required',
//             'side' => ['required', Rule::in(['BUY', 'SELL'])],
//             'derivate' => 'required',
//             'trade_setting_id' => 'nullable',
//         ]);

//         return view('user.profile', [
//             'user' => 1
//         ]);
//         // try
//         // {
//         //     $validatedRequest = $request->validated();
//         //     $validatedRequest['user_id'] = 1;
//         //     $this->tradeService->createTrade($validatedRequest);

//         //     return response()->json([]);
//         // }
//         // catch (\Exception $e)
//         // {
//         //     // Handle validation errors
//         //     return response()->json([
//         //         'message' => 'Validation failed',
//         //         'errors' => $e->getMessage(),
//         //     ], Response::HTTP_UNPROCESSABLE_ENTITY);
//         // }
//     }
// }
