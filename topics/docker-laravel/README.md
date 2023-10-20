# Topic: Docker & Laravel Sail

Run Laravel and its services (DB, Redis) in containers — no local PHP/MySQL
install.

## Laravel Sail (the easy path)

Sail is a thin CLI over a ready-made `docker-compose.yml` with PHP, MySQL,
Redis, Mailpit, and more.

```bash
composer require laravel/sail --dev
php artisan sail:install        # pick services (mysql, redis, ...)
./vendor/bin/sail up -d         # start containers
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm run dev
./vendor/bin/sail test
```

Tip: alias `sail` so you can drop `./vendor/bin/`:
`alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'`.
Everything you'd run with `php artisan` / `composer` / `npm` runs through
`sail` so it executes *inside* the container.

## A production-ish Dockerfile

Sail is for local dev; production usually wants a lean multi-stage image:

```dockerfile
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.* ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

FROM php:8.2-fpm-alpine
RUN docker-php-ext-install pdo_mysql opcache
WORKDIR /var/www
COPY . .
COPY --from=vendor /app/vendor ./vendor
RUN php artisan config:cache && php artisan route:cache
CMD ["php-fpm"]
```

- Multi-stage keeps Composer out of the final image.
- `config:cache` + `route:cache` at build time for speed (remember: `env()`
  outside config breaks once cached).
- Pair php-fpm with an nginx container, or use a single `serve`/Octane image
  for simple setups.

## Example

See `examples/Dockerfile`.

## Exercise

See `exercise.md`.
