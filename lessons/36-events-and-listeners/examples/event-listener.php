<?php

// ── app/Events/PostPublished.php ───────────────────────────
namespace App\Events;

use App\Models\Post;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostPublished
{
    use Dispatchable, SerializesModels;

    public function __construct(public Post $post) {}
}

// ── app/Listeners/NotifySubscribers.php ────────────────────
namespace App\Listeners;

use App\Events\PostPublished;
use Illuminate\Contracts\Queue\ShouldQueue;   // queue the listener
use Illuminate\Support\Facades\Log;

class NotifySubscribers implements ShouldQueue
{
    public function handle(PostPublished $event): void
    {
        Log::info('Notify subscribers about post', ['id' => $event->post->id]);
        // e.g. loop subscribers and queue mail
    }
}

// ── Registering (app/Providers/EventServiceProvider.php) ───
// protected $listen = [
//     PostPublished::class => [ NotifySubscribers::class ],
// ];

// ── Firing it (anywhere) ───────────────────────────────────
//   PostPublished::dispatch($post);
//   event(new PostPublished($post));
