# Exercise — Lesson 37

1. In `app/Console/Kernel.php`, add to `schedule()`:
   ```php
   $schedule->call(fn () => \Log::info('tick ' . now()))
            ->everyMinute();
   ```
2. Schedule a command (any you have, e.g. the built-in queue prune):
   ```php
   $schedule->command('queue:prune-batches')
            ->dailyAt('02:00')
            ->withoutOverlapping();
   ```
3. Run the scheduler locally:
   ```bash
   php artisan schedule:work
   ```
4. Inspect what's registered:
   ```bash
   php artisan schedule:list
   ```

**Done when:** `schedule:work` writes a `tick` to the log each minute, and
`schedule:list` shows both entries with their next run time.
