# Exercise — Lesson 03

1. Scaffold a resource controller:
   ```bash
   php artisan make:controller ProductController --resource
   ```
   Open it and note the seven methods Laravel generated (`index`, `create`,
   `store`, `show`, `edit`, `update`, `destroy`).
2. Create a model with its migration:
   ```bash
   php artisan make:model Product -m
   ```
3. Explore the app in Tinker:
   ```bash
   php artisan tinker
   >>> Str::slug('Hello Laravel 10')   // "hello-laravel-10"
   >>> now()->addDays(3)
   ```
4. List every route: `php artisan route:list`.

**Done when:** you can scaffold a controller + model and read live values in
Tinker.
