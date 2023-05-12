# Lesson 28: The Query Builder

When you don't need models — raw, fast, fluent SQL via `DB`.

## What you'll learn

- `DB::table('posts')` gives the same fluent API as Eloquent but returns plain
  `stdClass` rows (or arrays), not models. Lighter for reports and bulk work.
- Reads: `->where(...)->get()`, `->first()`, `->value('col')`, `->pluck()`,
  `->count()`, `->exists()`.
- Joins: `->join('users', 'posts.user_id', '=', 'users.id')`.
- Aggregates + grouping: `->select(...)->groupBy(...)->having(...)`.
- Writes: `->insert([...])`, `->update([...])`, `->delete()`,
  `->upsert(...)`.
- Raw escapes hatches: `DB::raw(...)`, `selectRaw`, `whereRaw` — and
  `DB::statement(...)` for anything else. Always bind parameters, never
  interpolate user input.
- `DB::transaction(fn () => ...)` wraps multiple writes atomically.

```php
$topAuthors = DB::table('posts')
    ->select('user_id', DB::raw('count(*) as total'))
    ->groupBy('user_id')
    ->having('total', '>', 5)
    ->orderByDesc('total')
    ->get();
```

## Example

See `examples/queries.php`.

## Exercise

1. `DB::table('tasks')->where('done', false)->count()`.
2. A grouped report: tasks per `done` status using `groupBy` + `DB::raw('count(*)')`.
3. Wrap two inserts in `DB::transaction(...)` and confirm both commit (or both
   roll back if you `throw` inside).
