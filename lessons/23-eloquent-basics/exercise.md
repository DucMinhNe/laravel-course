# Exercise — Lesson 23

1. Ensure you have a `Task` model + `tasks` table (Lesson 22).
2. Configure the model:
   ```php
   protected $fillable = ['title', 'done', 'due_at'];
   protected $casts = ['done' => 'boolean', 'due_at' => 'date'];
   ```
3. Drive it from Tinker:
   ```bash
   php artisan tinker
   >>> Task::create(['title' => 'Write lesson', 'done' => false]);
   >>> Task::create(['title' => 'Push to GitHub']);
   >>> Task::all();
   >>> $t = Task::first(); $t->update(['done' => true]);
   >>> Task::latest()->get();
   >>> Task::destroy(2);
   ```

**Done when:** you can create, read, update, and delete tasks, and `done`
comes back as a real boolean (not `"0"`/`"1"`).
