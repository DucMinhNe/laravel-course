# Lesson 37: Task scheduling

Cron, but defined in PHP and version-controlled.

## What you'll learn

- Define schedules in `app/Console/Kernel.php`'s `schedule()` method.
- Schedule closures, artisan commands, jobs, or shell:
  - `$schedule->command('emails:send')->daily();`
  - `$schedule->job(new PruneLogs)->hourly();`
  - `$schedule->call(fn () => ...)->everyFiveMinutes();`
- Frequencies: `->everyMinute()`, `->hourly()`, `->dailyAt('13:00')`,
  `->weekly()`, `->cron('* * * * *')`, plus `->weekdays()`, `->timezone(...)`.
- Guards: `->withoutOverlapping()`, `->onOneServer()`, `->when(fn () => ...)`.
- **One** real cron entry runs everything:
  ```
  * * * * * cd /path && php artisan schedule:run >> /dev/null 2>&1
  ```
- Test locally without cron: `php artisan schedule:work`.

## Example

See `examples/Kernel.php`.

## Exercise

1. In `Kernel::schedule()`, log a heartbeat every minute:
   `$schedule->call(fn () => \Log::info('tick'))->everyMinute();`
2. Schedule a custom command `->dailyAt('02:00')->withoutOverlapping()`.
3. Run `php artisan schedule:work` and watch the heartbeat fire.
