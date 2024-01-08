<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TestLoggingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected ?string $traceId = null)
    {
    }

    public function handle(): void
    {
        if ($this->traceId) {
            Log::withContext(['trace_id' => $this->traceId])
                ->debug('Logging Test in job with manual Trace ID', ['type' => config('logging.debug_type', 'not-set')]);
        } else {
            Log::debug('Logging Test in job', ['type' => config('logging.debug_type', 'not-set')]);
        }
    }
}
