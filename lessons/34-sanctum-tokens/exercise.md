# Exercise — Lesson 34

1. Install Sanctum:
   ```bash
   composer require laravel/sanctum
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```
2. Add the trait to `app/Models/User.php`:
   ```php
   use Laravel\Sanctum\HasApiTokens;
   class User extends Authenticatable { use HasApiTokens, /* ... */; }
   ```
3. Add the routes from `examples/api.php` (`/api/tokens`, `/api/me`).
4. Try it:
   ```bash
   TOKEN=$(curl -s -X POST localhost:8000/api/tokens \
     -H "Accept: application/json" \
     -d "email=demo@example.com&password=password&device=cli" | jq -r .token)

   curl -s localhost:8000/api/me -H "Authorization: Bearer $TOKEN"   # the user
   curl -s localhost:8000/api/me                                     # 401
   ```

**Done when:** `/api/me` returns the user with a valid token and `401` without
one.
