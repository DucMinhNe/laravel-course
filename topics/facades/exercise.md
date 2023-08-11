# Exercise — Facades

1. Use the `Cache` facade in a route:
   ```php
   Route::get('/cached-time', fn () => Cache::remember('time', 10, fn () => now()->toTimeString()));
   ```
   Reload within 10s — the time is frozen (served from cache).
2. Rewrite the same call using the `cache()` helper and confirm identical
   behaviour.
3. In a feature test, fake mail and assert nothing/something was sent:
   ```php
   Mail::fake();
   // hit a route that sends mail
   Mail::assertSent(\App\Mail\WelcomeMail::class);
   ```

**Done when:** you can express the same operation as a facade and a helper, and
you've faked a facade in a test.
