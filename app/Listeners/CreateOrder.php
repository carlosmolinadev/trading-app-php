<?php

namespace App\Listeners;

use App\Events\TradeOrderCreated;
use App\Events\UpdatedKlineData;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrder implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //!
    }
    public $queue = 'test';
    public string $test;
    public int $count = 0;
    public int $klineCount = 0;
    public bool $stop = false;

    /**
     * Handle the event.
     */
    public function handleOrderCreated(TradeOrderCreated $event): void
    {
        echo "Running OrderCreated.\n";
        $annother = $event;
        $this->test = 'Another Time';
        $this->stop = true;
    }

    /**!
     * Handle the event.
     */
    public function handleKlineData(UpdatedKlineData $event): void
    {
        echo "Running KlineData.\n";
        $this->test = 'Another Time';
        while (!$this->stop)
        {
            sleep(1);
            $this->klineCount++;
            if ($this->klineCount > 10)
            {
                break;
            }
        }
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            TradeOrderCreated::class,
            [CreateOrder::class, 'handleOrderCreated']
        );
        $events->listen(
            UpdatedKlineData::class,
            [UpdateKlineData::class, 'handleKlineData']
        );
    }
    public $uniqueFor = 3600;

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        echo "Unique Id.\n";
        return $this->test;
    }
}
