# Lesson 09: Controllers

Move route logic out of closures and into classes you can test and reuse.

## What you'll learn

- Generate one: `php artisan make:controller PostController`.
- Controllers live in `app/Http/Controllers` and extend the base `Controller`.
- Wire a route to an action: `[PostController::class, 'index']`.
- Each public method is an **action**. Type-hinted arguments (the `Request`,
  route models, services) are injected automatically by the container.
- Keep controllers thin: validate, call a model/service, return a response.

```php
class PostController extends Controller
{
    public function index()
    {
        return Post::latest()->get();
    }

    public function show(Post $post)   // route model binding
    {
        return $post;
    }
}
```

## Example

See `examples/PostController.php`.

## Exercise

1. `php artisan make:controller PageController`.
2. Add an `about()` action returning a string, wire it to `GET /about`.
3. Add a `contact()` action returning JSON, wire it to `GET /contact`.
