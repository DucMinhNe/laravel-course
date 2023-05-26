# Exercise — Lesson 29

1. In a fresh app, install Breeze:
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install && npm run dev
   php artisan migrate
   ```
2. Register a user at `/register`, then log in.
3. Add a protected route:
   ```php
   Route::get('/secret', fn () => 'members only')->middleware('auth');
   ```
   Visit it logged out → redirected to `/login`. Log in → it loads.
4. In a Blade view:
   ```blade
   @auth Logged in as {{ auth()->user()->name }} @endauth
   @guest <a href="/login">Log in</a> @endguest
   ```

**Done when:** registration works, `/secret` is gated, and the UI reflects
login state.
