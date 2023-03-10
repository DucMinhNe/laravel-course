# Lesson 01: Setting up Laravel 10

Install PHP and Composer, create a Laravel 10 project, and run it.

## What you'll learn

- Laravel 10 needs **PHP 8.1+**. Check with `php -v`.
- [Composer](https://getcomposer.org/) is PHP's package manager. Check with `composer -V`.
- Create a project: `composer create-project laravel/laravel:^10.0 myapp`
- Run the dev server: `cd myapp && php artisan serve` → http://127.0.0.1:8000
- Optional: the [Laravel installer](https://laravel.com/docs/10.x/installation) (`laravel new myapp`) and [Laravel Sail](https://laravel.com/docs/10.x/sail) (Docker) for a zero-PHP-install setup.

## Example

See `examples/check-version.php` — a tiny script that verifies your PHP version
is new enough for Laravel 10.

```bash
php examples/check-version.php
```

## Exercise

Create a fresh Laravel 10 app and serve it:

```bash
composer create-project laravel/laravel:^10.0 blog
cd blog
php artisan serve
```

Open the browser to `http://127.0.0.1:8000` and confirm you see the Laravel
welcome page. Then run `php artisan --version` and note the version string.
