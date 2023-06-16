# Exercise — Lesson 38

1. Make sure tests use an in-memory DB (`phpunit.xml`):
   ```xml
   <env name="DB_CONNECTION" value="sqlite"/>
   <env name="DB_DATABASE" value=":memory:"/>
   ```
2. Generate the test:
   ```bash
   php artisan make:test TaskApiTest
   ```
   ```php
   use Illuminate\Foundation\Testing\RefreshDatabase;

   class TaskApiTest extends \Tests\TestCase
   {
       use RefreshDatabase;

       public function test_it_creates_a_task(): void
       {
           $this->postJson('/api/tasks', ['title' => 'Write tests'])
                ->assertCreated();
           $this->assertDatabaseHas('tasks', ['title' => 'Write tests']);
       }

       public function test_title_is_required(): void
       {
           $this->postJson('/api/tasks', [])
                ->assertStatus(422)
                ->assertJsonValidationErrors('title');
       }
   }
   ```
3. Run them:
   ```bash
   php artisan test
   ```

**Done when:** `php artisan test` is green and both cases pass against a fresh
in-memory database.
