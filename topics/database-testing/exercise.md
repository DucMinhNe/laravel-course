# Exercise — Database testing

1. Enable the in-memory SQLite DB in `phpunit.xml`:
   ```xml
   <env name="DB_CONNECTION" value="sqlite"/>
   <env name="DB_DATABASE" value=":memory:"/>
   ```
2. Write a test with `RefreshDatabase` that:
   - creates a task via the API,
   - asserts `assertDatabaseHas('tasks', [...])` and
     `assertDatabaseCount('tasks', 1)`.
3. Add a soft-delete test using `assertSoftDeleted($task)`.
4. Use a factory relationship
   (`User::factory()->has(Task::factory()->count(3))->create()`) and assert the
   count.

**Done when:** tests run against a throwaway DB, pass in isolation, and your
database assertions verify the persisted state.
