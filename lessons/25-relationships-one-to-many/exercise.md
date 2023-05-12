# Exercise — Lesson 25

1. Add `user_id` to the tasks table (migration):
   ```php
   $table->foreignId('user_id')->constrained()->cascadeOnDelete();
   ```
2. Define the relations:
   ```php
   // User.php
   public function tasks() { return $this->hasMany(Task::class); }
   // Task.php
   public function user()  { return $this->belongsTo(User::class); }
   ```
3. In Tinker:
   ```php
   $u = User::first();
   $u->tasks()->create(['title' => 'Read docs']);
   $u->tasks;            // Collection
   Task::first()->user;  // back to the User
   User::with('tasks')->get();   // eager loaded
   ```

**Done when:** you can create a task through the user and traverse the relation
both directions.
