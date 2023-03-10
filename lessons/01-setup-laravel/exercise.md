# Exercise — Lesson 01

1. Confirm your toolchain:
   ```bash
   php -v          # must be 8.1+
   composer -V
   ```
2. Create a new Laravel 10 project called `blog`:
   ```bash
   composer create-project laravel/laravel:^10.0 blog
   ```
3. Serve it and open the welcome page:
   ```bash
   cd blog && php artisan serve
   ```
4. Record the framework version:
   ```bash
   php artisan --version
   ```

**Done when:** the welcome page renders and `artisan --version` reports
`Laravel Framework 10.x`.
