# Exercise — The N+1 problem

1. Seed ~20 posts each belonging to a user.
2. Reproduce the N+1 and count queries:
   ```php
   DB::enableQueryLog();
   foreach (Post::all() as $p) { $p->user->name; }
   count(DB::getQueryLog());   // ~21
   ```
3. Fix it and re-count:
   ```php
   DB::flushQueryLog();
   foreach (Post::with('user')->get() as $p) { $p->user->name; }
   count(DB::getQueryLog());   // 2
   ```
4. Add `Model::preventLazyLoading(! app()->isProduction());` to
   `AppServiceProvider::boot()` and confirm the un-eager-loaded version now
   throws in local.

**Done when:** you can show the query count drop from N+1 to 2, and lazy loading
throws in development.
