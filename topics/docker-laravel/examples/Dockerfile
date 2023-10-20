# Multi-stage production image for a Laravel 10 app.

# --- Stage 1: install PHP deps with Composer (kept out of final image) ---
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction --no-progress

# --- Stage 2: build frontend assets ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json vite.config.* ./
RUN npm ci
COPY resources ./resources
RUN npm run build

# --- Stage 3: the runtime image ---
FROM php:8.2-fpm-alpine
RUN docker-php-ext-install pdo_mysql opcache bcmath
WORKDIR /var/www

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Bake caches for speed (env() outside config/* won't work after this)
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

EXPOSE 9000
CMD ["php-fpm"]
