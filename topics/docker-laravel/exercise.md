# Exercise — Docker & Sail

1. Add Sail to a fresh app and pick MySQL + Redis:
   ```bash
   composer require laravel/sail --dev
   php artisan sail:install
   ```
2. Bring it up and migrate inside the container:
   ```bash
   ./vendor/bin/sail up -d
   ./vendor/bin/sail artisan migrate
   ./vendor/bin/sail artisan tinker
   ```
3. Confirm the app responds at `http://localhost` and that `sail artisan
   db:show` reports the containerised MySQL.
4. (Stretch) Write the multi-stage `Dockerfile` from `examples/` and
   `docker build .` it — note the final image has no Composer/Node in it.

**Done when:** the app + database run entirely in containers via Sail, and you
understand why production uses a separate lean multi-stage image.
