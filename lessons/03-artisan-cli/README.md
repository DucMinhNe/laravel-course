# Lesson 03: The `artisan` CLI

`artisan` is Laravel's command-line assistant. You'll use it constantly.

## What you'll learn

- `php artisan list` — every available command.
- `php artisan help <command>` — flags and arguments for one command.
- The everyday commands:
  - `php artisan serve` — run the dev server
  - `php artisan make:controller PostController` — scaffold a controller
  - `php artisan make:model Post -mfc` — model + migration + factory + controller
  - `php artisan migrate` — run database migrations
  - `php artisan route:list` — show every registered route
  - `php artisan tinker` — an interactive REPL with your app booted
- Production helpers: `config:cache`, `route:cache`, `view:cache`,
  `optimize` (and their `*:clear` counterparts).

## Example

See `examples/common-commands.sh` for a cheat sheet.

## Exercise

In a fresh app:

1. `php artisan make:controller HelloController`
2. `php artisan route:list` — note that no route uses it yet.
3. `php artisan tinker`, then run `now()` and `Str::slug('Hello World')`.
4. `php artisan make:model Product -m` and look at the two files it created.
