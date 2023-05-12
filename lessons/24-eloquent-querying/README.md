# Lesson 24: Querying with Eloquent

Build expressive, chainable queries that return models or collections.

## What you'll learn

- Constraints: `where('col', '>', 10)`, `whereIn`, `whereNull`, `whereBetween`,
  `orWhere`, `whereDate`.
- Ordering & limiting: `orderBy`, `latest()` / `oldest()`, `limit`, `take`.
- Retrieval: `get()`, `first()`, `find()`, `value('col')`, `pluck('col')`,
  `count()`, `exists()`.
- Pagination: `paginate(15)` — returns a paginator with links.
- Aggregates: `count()`, `sum('amount')`, `avg`, `max`, `min`.
- `firstOrCreate(...)`, `updateOrCreate(...)` for upserts.
- Results are **Collections** — chain `->map()`, `->filter()`, `->pluck()`.

```php
$recent = Post::where('published', true)
    ->whereDate('published_at', '>=', now()->subWeek())
    ->latest('published_at')
    ->paginate(10);
```

## Example

See `examples/queries.php`.

## Exercise

Using your `Task` model:

1. Get all tasks where `done = false`, newest first.
2. Count how many are done.
3. `pluck('title')` of the undone tasks.
4. `updateOrCreate(['title' => 'Daily standup'], ['done' => false])`.
