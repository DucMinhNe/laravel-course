# Exercise — Lesson 16

1. Generate the middleware:
   ```bash
   php artisan make:middleware EnsureTokenIsValid
   ```
2. In `handle()`, reject requests missing the right header:
   ```php
   if ($request->header('X-Token') !== 'secret') {
       abort(401);
   }
   return $next($request);
   ```
3. Alias it in `app/Http/Kernel.php`:
   ```php
   protected $middlewareAliases = [
       // ...
       'token' => \App\Http\Middleware\EnsureTokenIsValid::class,
   ];
   ```
4. Protect a route:
   ```php
   Route::get('/private', fn () => 'top secret')->middleware('token');
   ```

**Done when:** `/private` returns 401 without the header and the content with
`X-Token: secret`. Bonus: add `->middleware('throttle:5,1')` and hammer it.
