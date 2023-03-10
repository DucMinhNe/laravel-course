# Lesson 02: Project structure

Know where everything lives before you write a line of code.

## What you'll learn

The top-level folders of a fresh Laravel 10 app:

- **`app/`** — your application code. `Http/Controllers`, `Models`,
  `Providers`, `Http/Middleware` live here.
- **`routes/`** — URL definitions. `web.php` (session/CSRF), `api.php`
  (stateless), `console.php`, `channels.php`.
- **`resources/`** — `views/` (Blade templates), `css/`, `js/`, `lang/`.
- **`database/`** — `migrations/`, `seeders/`, `factories/`.
- **`config/`** — one file per subsystem (`app.php`, `database.php`, …).
- **`public/`** — the web root. `index.php` is the single entry point; nothing
  else is web-accessible.
- **`storage/`** — logs, compiled Blade, file uploads, caches.
- **`bootstrap/`** — framework bootstrap + `cache/` for compiled config/routes.
- **`tests/`** — `Feature/` and `Unit/` tests.
- **`vendor/`** — Composer dependencies (never edited, never committed).

## Example

See `examples/structure.txt` for an annotated tree.

## Exercise

In a fresh app, answer (by locating the file/folder):

1. Where would a `PostController` go?
2. Where do you define the `/posts` URL?
3. Where does the Blade view for the posts page live?
4. Which folder is the public web root?
