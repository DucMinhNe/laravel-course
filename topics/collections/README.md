# Topic: Collections

A fluent, chainable wrapper around arrays — and what Eloquent returns.

## Why

Every `->get()` returns a `Collection`, not a plain array. The Collection API
turns loops into readable pipelines, and it's lazy-evaluation friendly.

## The methods you'll reach for

```php
$users = collect([...]);

$users->map(fn ($u) => $u->name);          // transform
$users->filter(fn ($u) => $u->active);     // keep matching
$users->reject(fn ($u) => $u->banned);     // drop matching
$users->pluck('email');                    // one field → flat collection
$users->keyBy('id');                       // index by a key
$users->groupBy('role');                   // → ['admin' => [...], ...]
$users->sortBy('name');  $users->sortByDesc('score');
$users->sum('points');  $users->avg('age');  $users->max('score');
$users->first(fn ($u) => $u->admin);  $users->firstWhere('role', 'admin');
$users->where('active', true);             // like SQL where, in memory
$users->unique('email');  $users->take(5);  $users->chunk(100);
$users->each(fn ($u) => ...);              // side effects
$users->reduce(fn ($carry, $u) => $carry + $u->points, 0);
```

- Chain freely; each step returns a new Collection.
- `->values()` re-indexes after a filter; `->all()` / `->toArray()` to escape.
- **Higher-order messages**: `$users->each->notify()`,
  `$users->map->name` — terse shortcuts for single-method callbacks.

## LazyCollection for big data

`Model::cursor()` or `LazyCollection` streams rows one at a time instead of
loading everything into memory — essential for processing millions of records.

```php
User::cursor()->each(fn ($u) => ...);   // constant memory
```

## Example

See `examples/collections.php`.

## Exercise

See `exercise.md`.
