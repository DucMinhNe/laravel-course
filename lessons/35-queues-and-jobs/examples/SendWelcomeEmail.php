<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;       // retry up to 3 times on failure
    public int $backoff = 10;    // wait 10s between retries

    // Models are serialized by id and re-fetched in the worker.
    public function __construct(public User $user) {}

    public function handle(): void
    {
        // Pretend to send an email (slow work that shouldn't block the request)
        Log::info('Sending welcome email', ['user' => $this->user->id]);
        // Mail::to($this->user)->send(new WelcomeMail($this->user));
    }

    // Called after the final retry fails
    public function failed(\Throwable $e): void
    {
        Log::error('Welcome email failed', ['user' => $this->user->id, 'err' => $e->getMessage()]);
    }
}

// Dispatch:
//   SendWelcomeEmail::dispatch($user);
//   SendWelcomeEmail::dispatch($user)->delay(now()->addMinutes(5));
