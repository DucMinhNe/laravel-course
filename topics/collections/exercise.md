# Exercise — Collections

Given `$tasks = Task::all();` (or a `collect([...])` of arrays):

1. Count tasks grouped by `done` status with `groupBy('done')->map->count()`.
2. Get the titles of the 3 most recently due tasks:
   `->sortByDesc('due_at')->take(3)->pluck('title')`.
3. Sum an imaginary `points` field for only the done tasks using
   `->where('done', true)->sum('points')`.
4. Rewrite a `foreach` you'd normally write as a `map`/`filter` pipeline.

**Bonus:** process a large table with `Task::cursor()` and confirm memory stays
flat (vs `Task::all()`).

**Done when:** you can express grouping, sorting, and aggregation as a single
chained pipeline.
