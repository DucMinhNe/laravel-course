# Lesson 22: Migrations

Version-control your database schema — no more "run this SQL by hand".

## What you'll learn

- Generate: `php artisan make:migration create_posts_table`.
- A migration has `up()` (apply) and `down()` (roll back).
- The `Schema` builder + `Blueprint`:
  - `$table->id()`, `->string('title')`, `->text('body')`, `->boolean()`,
    `->foreignId('user_id')->constrained()->cascadeOnDelete()`,
    `->timestamps()`, `->softDeletes()`.
  - Modifiers: `->nullable()`, `->unique()`, `->default(...)`, `->index()`.
- Run them: `php artisan migrate`. Roll back the last batch: `migrate:rollback`.
  Nuke + rebuild (dev only): `migrate:fresh`.
- Each migration runs once; Laravel tracks applied ones in the `migrations` table.

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('body');
    $table->boolean('published')->default(false);
    $table->timestamps();
});
```

## Example

See `examples/create_posts_table.php`.

## Exercise

1. `make:migration create_tasks_table`.
2. Columns: `id`, `title` (string), `done` (bool default false),
   `due_at` (nullable date), `timestamps`.
3. `php artisan migrate`, then `migrate:rollback`, then `migrate` again.
