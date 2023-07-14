# Exercise — Soft deletes

1. Add `$table->softDeletes();` to the `tasks` table (new migration) and
   `use SoftDeletes;` on the `Task` model.
2. In Tinker:
   ```php
   $t = Task::first();
   $t->delete();                  // soft delete
   Task::count();                 // one fewer
   Task::withTrashed()->count();  // unchanged
   $t->trashed();                 // true
   Task::onlyTrashed()->restore();
   Task::count();                 // back up
   $t->forceDelete();             // really gone
   ```

**Done when:** a deleted task disappears from normal queries but reappears with
`withTrashed()`, can be restored, and `forceDelete()` removes it for good.
