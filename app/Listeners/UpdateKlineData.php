<?php

namespace App\Listeners;

use App\Events\UpdatedKlineData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateKlineData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdatedKlineData $event): void
    {
        //
    }
}
