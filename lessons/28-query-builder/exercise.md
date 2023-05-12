# Exercise — Lesson 28

```php
use Illuminate\Support\Facades\DB;

// 1. Count undone tasks (no model)
DB::table('tasks')->where('done', false)->count();

// 2. Report: how many tasks per done-status
DB::table('tasks')
    ->select('done', DB::raw('count(*) as total'))
    ->groupBy('done')
    ->get();

// 3. Atomic double insert
DB::transaction(function () {
    DB::table('tasks')->insert(['title' => 'First']);
    DB::table('tasks')->insert(['title' => 'Second']);
});
```

**Bonus:** add `throw new \Exception('rollback test');` at the end of the
transaction closure and confirm *neither* row was inserted.

**Done when:** you can read, aggregate, and transactionally write with the
query builder, and you understand it returns plain rows, not models.
