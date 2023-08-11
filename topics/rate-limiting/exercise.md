# Exercise — Rate limiting

1. Throttle a route inline and trip it:
   ```php
   Route::get('/ping', fn () => 'pong')->middleware('throttle:5,1');
   ```
   ```bash
   for i in $(seq 1 7); do curl -s -o /dev/null -w "%{http_code}\n" localhost:8000/ping; done
   # first 5 → 200, then 429
   ```
2. Define a named limiter `reports` allowing 3/min per user, apply it with
   `throttle:reports`, and inspect the `X-RateLimit-Remaining` header.
3. Use `RateLimiter::attempt(...)` to allow only 3 OTP sends per phone per
   minute.

**Done when:** the 6th request in a minute returns `429`, and your named
limiter keys correctly per user.
