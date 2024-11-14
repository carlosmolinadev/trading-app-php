<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TradeService;
use App\Services\SettingService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Trade\ApiKeyRequest;

class SettingController extends Controller
{
    private TradeService $tradeService;
    private SettingService $settingService;
    public function __construct(TradeService $tradeService, SettingService $settingService)
    {
        $this->tradeService = $tradeService;
        $this->settingService = $settingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try
        {
            $query = $request->query('exchange');
            $user = $request->user();
            if (!isset($user))
            {
                return response()->json([
                    'message' => 'User not found',
                ], Response::HTTP_NOT_FOUND);
            };
            return response()->json([
                $this->tradeService->getApikey($user->id, $query)
            ], Response::HTTP_OK);
        }
        catch (\Throwable $th)
        {
            Log::error($th->getMessage());
            return response()->json([
                'message' => 'Unable to retrieve api key',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function showApiKey(ApiKeyRequest $request)
    {
        try
        {
            $user = $request->user();
            if (!isset($user))
            {
                return response()->json([
                    'message' => 'User not found',
                ], Response::HTTP_NOT_FOUND);
            };
            if ($this->tradeService->createApikey($request))
            {
                return response()->json([
                    'message' => 'Apikey created successfully',
                ], Response::HTTP_CREATED);
            };
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function create(ApiKeyRequest $request)
    {
        try
        {
            $user = $request->user();
            if (!isset($user))
            {
                return response()->json([
                    'message' => 'User not found',
                ], Response::HTTP_NOT_FOUND);
            };
            return response()->json([
                $this->tradeService->createApikey($request)
            ], Response::HTTP_CREATED);
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Validation failed',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Request $request, int $id)
    // {
    //     try
    //     {
    //         $serchParams[] = $request->query('exchange');
    //         $serchParams[] = $request->query('status');
    //         return response()->json([$this->settingService->getSettings($id, $serchParams)], Response::HTTP_OK);
    //     }
    //     catch (\Throwable $th)
    //     {
    //         //throw $th;
    //     }
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
