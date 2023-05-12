# Lesson 27: Factories & seeders

Generate realistic fake data for development and tests.

## What you'll learn

- **Factories** define how to fake a model. `php artisan make:factory PostFactory`.
  Use Faker in `definition()`.
- Create records: `Post::factory()->count(20)->create()`,
  `Post::factory()->make()` (unsaved), `Post::factory()->create(['title' => 'X'])`
  to override.
- **States** for variants: `->published()`, `->draft()`.
- Relations: `Post::factory()->for(User::factory())->create()`,
  `User::factory()->has(Post::factory()->count(3))->create()`.
- **Seeders** populate the DB. `php artisan make:seeder PostSeeder`, call from
  `DatabaseSeeder::run()`, then `php artisan db:seed` or `migrate:fresh --seed`.

```php
public function definition(): array {
    return [
        'title'     => fake()->sentence(),
        'body'      => fake()->paragraphs(3, true),
        'published' => fake()->boolean(70),
    ];
}
```

## Example

See `examples/PostFactory.php` and `examples/DatabaseSeeder.php`.

## Exercise

1. `make:factory TaskFactory` faking `title` and `done`.
2. Add a `done()` state that forces `done => true`.
3. Seed 10 tasks (3 of them done) from `DatabaseSeeder`.
4. `php artisan migrate:fresh --seed` and verify the counts.
