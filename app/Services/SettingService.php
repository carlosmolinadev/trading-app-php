<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Date;

class SettingService
{
    public function addApiKey($data)
    {
        try
        {
            return DB::table('api_key')->insert([
                'public' => $data['public'],
                'private' => $data['private'],
                'exchange_id' => $data['exchange_id'],
                'user_id' => $data['user_id'],
                'created_at' => now()->format('Y-m-d H:i:s'),
            ]);
        }
        catch (\Exception $e)
        {
            Log::error($e->getMessage());
            return false;
        }
    }
};
