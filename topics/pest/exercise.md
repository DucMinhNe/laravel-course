# Exercise — Pest

1. Install Pest:
   ```bash
   composer require pestphp/pest --dev --with-all-dependencies
   php artisan pest:install
   ```
2. Write `tests/Feature/TaskTest.php` (Pest style) that:
   - `uses(RefreshDatabase::class)`,
   - tests `GET /api/tasks` returns the seeded count,
   - tests `POST /api/tasks` with no title returns `422`.
3. Add an `expect()` chain, e.g.
   `expect(Task::first()->title)->toBeString()->not->toBeEmpty();`.
4. Run: `php artisan test`.

**Done when:** the Pest suite is green and you've used both `it(...)` and an
`expect(...)` chain.
