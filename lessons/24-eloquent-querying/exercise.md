# Exercise — Lesson 24

In Tinker, against your `Task` model:

```php
// 1. Undone tasks, newest first
Task::where('done', false)->latest()->get();

// 2. How many are done
Task::where('done', true)->count();

// 3. Titles of undone tasks
Task::where('done', false)->pluck('title');

// 4. Upsert
Task::updateOrCreate(
    ['title' => 'Daily standup'],
    ['done' => false]
);
```

**Done when:** each query returns what you expect, and you understand that
`get()`/`pluck()` give you a **Collection** you can keep chaining on.
