# Exercise — Query scopes

1. On your `Task` model, add a local scope:
   ```php
   public function scopePending($query) { return $query->where('done', false); }
   public function scopeDueBefore($query, $date) { return $query->where('due_at', '<', $date); }
   ```
2. Use them chained:
   ```php
   Task::pending()->dueBefore(now()->addWeek())->get();
   ```
3. Add a global scope that hides tasks with `archived_at` set, then fetch the
   archived ones with `withoutGlobalScope(...)`.

**Done when:** `Task::pending()` works without writing the `where`, and the
global scope hides archived tasks by default.
