<?php

namespace App\Jobs;

use App\Models\Heartbeat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessHeartbeat implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        sleep(2);

        Heartbeat::create([
            'source' => 'queue',
            'message' => 'Queue processed at ' . now()->format('H:i:s'),
        ]);
    }
}
