# Topic: HTTP tests & fakes

Drive your app through real requests and assert on the response — without
hitting external services.

## Making requests

```php
$this->get('/posts');
$this->getJson('/api/posts');
$this->postJson('/api/posts', ['title' => 'Hi']);
$this->actingAs($user)->putJson("/api/posts/{$id}", [...]);
$this->withHeaders(['X-Token' => 'secret'])->get('/private');
```

## Response assertions

```php
$response->assertOk()                 // 200
         ->assertStatus(201)
         ->assertRedirect('/login')
         ->assertSee('Welcome')        // HTML body contains text
         ->assertDontSee('error')
         ->assertJson(['ok' => true])  // JSON subset match
         ->assertJsonCount(3, 'data')
         ->assertJsonPath('data.0.title', 'Hi')
         ->assertJsonValidationErrors('email')
         ->assertHeader('X-Foo', 'bar')
         ->assertSessionHas('status');
```

## Fakes — don't call the real world

Swap external services for spies so tests are fast, deterministic, and assert
intent:

```php
Mail::fake();            // then Mail::assertSent(OrderShipped::class)
Queue::fake();           // then Queue::assertPushed(ProcessPodcast::class)
Notification::fake();    // Notification::assertSentTo($user, InvoicePaid::class)
Event::fake();           // Event::assertDispatched(OrderShipped::class)
Bus::fake();             // Bus::assertBatched(...)
Storage::fake('public'); // Storage::disk('public')->assertExists('avatars/1.png')
Http::fake(['github.com/*' => Http::response(['ok' => true], 200)]);
```

## Tips

- Use `RefreshDatabase` so each test starts clean.
- `$this->withoutExceptionHandling()` to see the real exception instead of a
  rendered error page while debugging a test.
- `assertJsonStructure([...])` to assert shape without exact values.

## Example

See `examples/OrderTest.php`.

## Exercise

See `exercise.md`.
