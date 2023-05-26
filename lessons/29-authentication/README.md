# Lesson 29: Authentication

Log users in and out — using a starter kit or the underlying primitives.

## What you'll learn

- The fastest path: a **starter kit**. `composer require laravel/breeze --dev`
  then `php artisan breeze:install` scaffolds register/login/reset views,
  routes, and controllers you own and can edit.
- What it's built on (the primitives you should understand):
  - `Auth::attempt(['email' => ..., 'password' => ...])` — validate creds.
  - `Auth::login($user)`, `Auth::logout()`.
  - `Auth::user()` / `$request->user()` / the `auth()` helper.
  - `Auth::check()` — is anyone logged in?
- Passwords are hashed with `Hash::make()` and checked automatically; never
  store plaintext.
- Protect routes with the `auth` middleware; send guests to login.
- `@auth` / `@guest` Blade directives switch UI by login state.

```php
if (Auth::attempt($credentials, $remember)) {
    $request->session()->regenerate();   // prevent session fixation
    return redirect()->intended('/dashboard');
}
```

## Example

See `examples/auth-routes.php`.

## Exercise

1. Install Breeze in a fresh app and register a user.
2. Add a route protected by `->middleware('auth')` and confirm guests are
   redirected to `/login`.
3. Show the user's name with `@auth {{ auth()->user()->name }} @endauth`.
