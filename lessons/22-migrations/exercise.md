# Exercise — Lesson 22

1. Generate the migration:
   ```bash
   php artisan make:migration create_tasks_table
   ```
2. Define the schema in `up()`:
   ```php
   Schema::create('tasks', function (Blueprint $table) {
       $table->id();
       $table->string('title');
       $table->boolean('done')->default(false);
       $table->date('due_at')->nullable();
       $table->timestamps();
   });
   ```
3. Apply and roll back to confirm `down()` works:
   ```bash
   php artisan migrate
   php artisan migrate:rollback
   php artisan migrate
   ```

**Done when:** the `tasks` table appears, rolls back cleanly, and re-applies.
Check with `php artisan db:table tasks` or your DB client.
