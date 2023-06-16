# Lesson 38: Testing

Laravel ships testing as a first-class citizen — write tests for real.

## What you'll learn

- Two suites: **Feature** (boot the app, hit routes) and **Unit** (a class in
  isolation). Generate: `php artisan make:test PostTest`
  (`--unit` for a unit test). Laravel 10 supports PHPUnit and Pest.
- Run them: `php artisan test` (or `vendor/bin/phpunit`).
- HTTP assertions: `$this->get('/posts')->assertOk()`,
  `assertStatus(201)`, `assertJson([...])`, `assertRedirect('/login')`,
  `assertSee('text')`.
- Database: use the `RefreshDatabase` trait (migrates a fresh, rolled-back DB
  per test). Assert with `assertDatabaseHas('posts', [...])`,
  `assertDatabaseCount('posts', 3)`.
- Acting as a user: `$this->actingAs($user)->post(...)`.
- Factories make the data: `Post::factory()->count(3)->create()`.
- Use an in-memory SQLite DB for tests via `phpunit.xml`
  (`DB_CONNECTION=sqlite`, `DB_DATABASE=:memory:`).

```php
public function test_guest_cannot_create_post(): void
{
    $this->post('/posts', ['title' => 'Hi'])->assertRedirect('/login');
    $this->assertDatabaseCount('posts', 0);
}
```

## Example

See `examples/PostTest.php`.

## Exercise

1. `php artisan make:test TaskApiTest`.
2. With `RefreshDatabase`: test that `POST /api/tasks` creates a task (assert
   `201` + `assertDatabaseHas`).
3. Test that posting without a title returns `422`.
4. Run `php artisan test` and get it green.
