# Exercise — Lesson 27

1. Generate a factory:
   ```bash
   php artisan make:factory TaskFactory
   ```
   ```php
   public function definition(): array {
       return [
           'title' => fake()->sentence(3),
           'done'  => false,
       ];
   }
   public function done(): static {
       return $this->state(fn () => ['done' => true]);
   }
   ```
2. Seed from `DatabaseSeeder::run()`:
   ```php
   Task::factory()->count(7)->create();
   Task::factory()->count(3)->done()->create();
   ```
3. Rebuild + seed:
   ```bash
   php artisan migrate:fresh --seed
   ```

**Done when:** `Task::count()` is 10 and `Task::where('done', true)->count()`
is 3.
