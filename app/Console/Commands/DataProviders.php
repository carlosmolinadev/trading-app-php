<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;

class DataProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:data-providers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo 'starting process...';
        $collection = collect([1, 2, 3, 4, 5]);
        sleep(5);
        DB::insert('INSERT INTO data_provider (name, payload, exchange, running) VALUES (?, ?, ?, ?)', ['account_provider', $collection->random(), 'binance', true]);

        $payload = DB::table('data_provider')->where('name', 'account_provider')->get();
        if ($payload->isEmpty())
        {
            return;
        }
    }
}
