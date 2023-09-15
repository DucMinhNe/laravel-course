# Topic: Caching

Skip expensive work by remembering its result.

## The API

```php
use Illuminate\Support\Facades\Cache;

Cache::put('key', $value, now()->addMinutes(10));   // store with TTL
Cache::get('key', 'default');                        // read
Cache::has('key');
Cache::forget('key');
Cache::increment('hits');

// The pattern you'll use most — compute once, reuse until TTL:
$stats = Cache::remember('dashboard:stats', 600, function () {
    return expensiveQuery();   // only runs on a miss
});

// Forever + manual invalidation:
Cache::rememberForever('config:flags', fn () => loadFlags());
```

## Drivers

Set `CACHE_DRIVER` in `.env`:
- `file` / `database` — fine for one server.
- `redis` / `memcached` — needed for multiple servers (shared) and required for
  cache **tags**.
- `array` — in-memory, per-request (great for tests).

## Tags (Redis/Memcached only)

Group keys so you can flush a whole set:

```php
Cache::tags(['users', "user:{$id}"])->put('profile', $data, 3600);
Cache::tags(["user:{$id}"])->flush();   // invalidate everything for one user
```

## Invalidation is the hard part

Cache the right granularity and bust it on writes (model `saved`/`deleted`
events, or explicit `forget` in the update path). Stale cache is worse than no
cache. Add a short TTL as a safety net even when you invalidate manually.

## Don't confuse with config/route cache

`config:cache`, `route:cache`, `view:cache` are *deployment* optimisations, not
the application cache. Different thing, same word.

## Example

See `examples/caching.php`.

## Exercise

See `exercise.md`.
