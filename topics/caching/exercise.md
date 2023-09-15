# Exercise — Caching

1. Cache an expensive query for 60s:
   ```php
   Route::get('/stats', fn () => Cache::remember('stats', 60, function () {
       sleep(1);                       // simulate slow work
       return ['count' => \App\Models\Task::count(), 'at' => now()->toTimeString()];
   }));
   ```
   First hit is slow; reloads within 60s are instant and show the same `at`.
2. Bust the cache when a task is created (`Cache::forget('stats')` in the store
   path or a model `saved` listener) and confirm `/stats` refreshes.
3. (Redis) Tag a few keys under `['tasks']` and flush them all with
   `Cache::tags(['tasks'])->flush()`.

**Done when:** the cached value is reused until TTL or an explicit bust, and you
can invalidate a group with tags.
