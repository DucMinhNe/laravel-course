# Topic: Database testing

Test code that touches the database without wrecking your dev data.

## A clean database per test

```php
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;   // migrate once, wrap each test in a rolled-back transaction
}
```

- `RefreshDatabase` is the default — fast, runs migrations then rolls back after
  each test so tests never see each other's data.
- `DatabaseMigrations` re-migrates fully each test (slower; use when a test
  commits or truncates).

## Use an in-memory SQLite DB for tests

In `phpunit.xml` (Laravel ships this commented):

```xml
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

Tests run against a throwaway in-memory DB — fast and isolated from your real
one. (Use a MySQL/Postgres test DB if you rely on engine-specific features.)

## Arrange with factories

```php
$user = User::factory()->has(Task::factory()->count(3))->create();
Task::factory()->done()->create(['title' => 'Shipped']);
```

## Database assertions

```php
$this->assertDatabaseHas('tasks', ['title' => 'X', 'done' => true]);
$this->assertDatabaseMissing('tasks', ['title' => 'Deleted']);
$this->assertDatabaseCount('tasks', 3);
$this->assertModelExists($task);
$this->assertModelMissing($deletedTask);
$this->assertSoftDeleted($task);          // deleted_at set
```

## Example

See `examples/TaskDatabaseTest.php`.

## Exercise

See `exercise.md`.
