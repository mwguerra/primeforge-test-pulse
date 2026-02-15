<?php

namespace App\Console\Commands;

use App\Jobs\ProcessHeartbeat;
use App\Models\Heartbeat;
use Illuminate\Console\Command;

class HeartbeatCommand extends Command
{
    protected $signature = 'app:heartbeat';

    protected $description = 'Create a scheduler heartbeat and dispatch a queue job';

    public function handle(): void
    {
        Heartbeat::create([
            'source' => 'scheduler',
            'message' => 'Scheduler tick at ' . now()->format('H:i:s'),
        ]);

        ProcessHeartbeat::dispatch();

        $this->info('Heartbeat created and job dispatched.');
    }
}
