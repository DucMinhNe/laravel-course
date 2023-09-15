<?php

use Illuminate\Support\Facades\Cache;
use App\Models\Post;

// Compute-once, reuse-until-TTL (the workhorse)
$popular = Cache::remember('posts:popular', 600, function () {
    return Post::where('views', '>', 1000)->latest()->take(10)->get();
});

// Manual put/get/forget
Cache::put('maintenance', true, now()->addHour());
if (Cache::get('maintenance', false)) { /* show banner */ }
Cache::forget('maintenance');

// Counters
Cache::increment('page:home:hits');

// Tagged caching (Redis/Memcached) — flush a related group at once
Cache::tags(['posts'])->put("post:{$id}", $post, 3600);
Cache::tags(['posts'])->flush();   // bust all post caches after a write

// Bust on model change (e.g. in an observer or booted()):
//   static::saved(fn () => Cache::forget('posts:popular'));
