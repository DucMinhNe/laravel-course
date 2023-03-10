#!/usr/bin/env bash
# A cheat sheet of the artisan commands you'll use most.
# (Reference — run them inside a real Laravel project.)

# --- Discovery ---
php artisan list                      # all commands
php artisan help make:model           # flags for one command
php artisan about                     # environment + package summary

# --- Dev server ---
php artisan serve                     # http://127.0.0.1:8000
php artisan serve --port=9000

# --- Scaffolding (make:*) ---
php artisan make:controller PostController
php artisan make:controller PostController --resource
php artisan make:model Post -mfc      # model + migration + factory + controller
php artisan make:migration create_posts_table
php artisan make:request StorePostRequest
php artisan make:middleware EnsureUserIsAdmin
php artisan make:seeder PostSeeder

# --- Database ---
php artisan migrate                   # run pending migrations
php artisan migrate:fresh --seed      # drop all, re-migrate, seed
php artisan db:seed

# --- Inspection ---
php artisan route:list                # every route
php artisan tinker                    # interactive REPL

# --- Production caches ---
php artisan optimize                  # cache config + routes + views
php artisan optimize:clear            # clear them all
