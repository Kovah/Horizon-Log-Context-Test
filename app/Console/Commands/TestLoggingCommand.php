<?php

namespace App\Console\Commands;

use App\Jobs\TestLoggingJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TestLoggingCommand extends Command
{
    protected $signature = 'logging:test';

    protected $description = 'Command description';

    public function handle()
    {
        Log::debug('Logging Test in command', ['type' => config('logging.debug_type', 'not-set')]);

        dispatch(new TestLoggingJob());

        $traceID = Str::ulid();
        Log::withContext(['trace_id' => (string)$traceID])
            ->debug('Logging Test in command with manual Trace ID', ['type' => config('logging.debug_type', 'not-set')]);

        dispatch(new TestLoggingJob($traceID));

        $this->info('Logging test completed');
    }
}
