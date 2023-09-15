# Exercise — Mass assignment

1. Add an `is_admin` boolean column to `users` (default false). Leave it OUT of
   `$fillable`.
2. Try to escalate via mass assignment:
   ```php
   $u = User::create(['name' => 'X', 'email' => 'x@e.com', 'password' => bcrypt('secret'), 'is_admin' => true]);
   $u->is_admin;   // false — the guard dropped it
   ```
3. Switch to validating first and assign only `$request->validated()`.
4. Add `Model::preventSilentlyDiscardingAttributes(! app()->isProduction())` to
   `AppServiceProvider::boot()` and re-run step 2 — it should now throw in local.

**Done when:** a malicious `is_admin=true` can't be set via mass assignment, and
dev mode throws on unexpected keys.
