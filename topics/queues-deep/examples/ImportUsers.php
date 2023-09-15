<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

// ShouldBeUnique: only one job with this uniqueId queued at a time.
class ImportUsers implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, Batchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];   // escalating retry delays

    public function __construct(public int $fileId) {}

    public function uniqueId(): string { return (string) $this->fileId; }

    public function handle(): void
    {
        if ($this->batch()?->cancelled()) {
            return;   // a sibling job failed and the batch was cancelled
        }
        // ... idempotent import work (safe to run twice) ...
        Log::info('Imported file', ['id' => $this->fileId]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('Import failed', ['id' => $this->fileId, 'err' => $e->getMessage()]);
    }
}

// Batch dispatch:
//   Bus::batch([new ImportUsers(1), new ImportUsers(2)])
//      ->then(fn () => Log::info('done'))
//      ->name('import')->dispatch();
