<?php

namespace App\Actions;

use App\Models\Post;
use App\Contracts\Notifier;
use Illuminate\Support\Facades\DB;

// A single-purpose action: one use case, one public method.
class PublishPost
{
    // Dependencies injected by the container — testable & swappable.
    public function __construct(private Notifier $notifier) {}

    public function execute(Post $post): Post
    {
        return DB::transaction(function () use ($post) {
            $post->update([
                'published'    => true,
                'published_at' => now(),
            ]);

            // side effect after the state change
            $this->notifier->postPublished($post);

            return $post;
        });
    }
}

// Reusable everywhere, no HTTP needed:
//   Controller:  $action->execute($post);
//   Job:         app(PublishPost::class)->execute($post);
//   Command:     resolve(PublishPost::class)->execute($post);
//
// Test:  swap Notifier for a fake via the container, call execute(), assert.
