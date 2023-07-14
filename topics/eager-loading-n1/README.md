# Topic: The N+1 problem & eager loading

The most common Eloquent performance bug, and its one-line fix.

## The problem

```php
$posts = Post::all();              // 1 query
foreach ($posts as $post) {
    echo $post->user->name;        // +1 query PER post  → N+1
}
```

100 posts = 101 queries. It hides in views and serializers, so it's easy to ship.

## The fix: eager load

```php
$posts = Post::with('user')->get();   // 2 queries total, regardless of N
```

- Multiple / nested: `Post::with(['user', 'comments.author'])->get()`.
- Constrained: `Post::with(['comments' => fn ($q) => $q->where('approved', true)])`.
- Lazy eager load (already have the models): `$posts->load('user')`.
- Load only if missing: `$posts->loadMissing('user')`.
- Counts without the rows: `Post::withCount('comments')`.

## Catch it automatically

In `AppServiceProvider::boot()`, make lazy loading throw in development so an
N+1 fails the test instead of silently slowing prod:

```php
use Illuminate\Database\Eloquent\Model;

Model::preventLazyLoading(! app()->isProduction());
```

## Verify it

Count queries with the query log or Laravel Debugbar / Telescope:

```php
\DB::enableQueryLog();
// ... run code ...
count(\DB::getQueryLog());   // should be small and constant
```

## Example

See `examples/n1.php`.

## Exercise

See `exercise.md`.
