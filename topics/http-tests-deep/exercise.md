# Exercise — HTTP tests & fakes

1. Test the JSON shape of your task API:
   ```php
   $this->getJson('/api/tasks')
        ->assertOk()
        ->assertJsonStructure(['data' => [['id', 'title', 'done']]]);
   ```
2. Fake the queue and assert a job is pushed when a task is created:
   ```php
   Queue::fake();
   $this->postJson('/api/tasks', ['title' => 'X'])->assertCreated();
   Queue::assertPushed(\App\Jobs\LogTaskCreated::class);
   ```
3. Fake an outbound HTTP call with `Http::fake([...])` and assert it was sent
   with `Http::assertSent(...)`.
4. Use `$this->withoutExceptionHandling()` to surface a real error in a failing
   test.

**Done when:** your tests assert response shape and verify side effects (queue,
mail, HTTP) **without** touching the real services.
