# Lesson 34: API tokens with Sanctum

Issue bearer tokens so mobile apps and third parties can call your API.

## What you'll learn

- Install: `composer require laravel/sanctum`, publish + migrate. Add the
  `HasApiTokens` trait to the `User` model.
- Two modes:
  - **API tokens** — `$user->createToken('phone')->plainTextToken`. Client
    sends `Authorization: Bearer <token>`.
  - **SPA auth** — cookie-based for first-party single-page apps on the same
    domain.
- Protect routes with `->middleware('auth:sanctum')`.
- **Abilities** (scopes): `createToken('name', ['posts:read'])`, then check
  with `$user->tokenCan('posts:read')`.
- Revoke: `$user->tokens()->delete()` (all) or delete the current one on logout.

```php
Route::middleware('auth:sanctum')->get('/user', fn (Request $r) => $r->user());
```

## Example

See `examples/api.php`.

## Exercise

1. Install Sanctum and add `HasApiTokens` to `User`.
2. A `POST /api/tokens` route that validates email+password and returns a new
   token.
3. A `GET /api/me` route behind `auth:sanctum` returning the user.
4. Call `/api/me` with `Authorization: Bearer <token>` and confirm it works
   (and 401s without it).
