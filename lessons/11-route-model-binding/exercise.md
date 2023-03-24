# Exercise — Lesson 11

1. Create the model + migration:
   ```bash
   php artisan make:model Post -m
   ```
   In the migration add `$table->string('slug')->unique();` then `migrate`.
2. Bind by id:
   ```php
   Route::get('/posts/{post}', fn (App\Models\Post $post) => $post);
   ```
3. Bind by slug:
   ```php
   Route::get('/p/{post:slug}', fn (App\Models\Post $post) => $post);
   ```
4. Visit `/posts/999999` (nonexistent) and confirm you get a **404**, not an
   error — that's binding doing the `findOrFail` for you.

**Done when:** both routes resolve a real post, and a missing one 404s.
