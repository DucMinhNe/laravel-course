# Topic: Custom artisan commands

Wrap any task — cleanup, imports, reports — in a first-class CLI command.

## Generate & shape

`php artisan make:command PruneTasks` creates a class in `app/Console/Commands`.

```php
class PruneTasks extends Command
{
    // name + arguments + options, all in one signature string
    protected $signature = 'tasks:prune {days=30 : Delete done tasks older than N days}
                                         {--dry-run : Show what would be deleted}';

    protected $description = 'Delete completed tasks older than N days';

    public function handle(): int
    {
        $days = (int) $this->argument('days');
        $cutoff = now()->subDays($days);

        $query = Task::where('done', true)->where('updated_at', '<', $cutoff);

        if ($this->option('dry-run')) {
            $this->info("Would delete {$query->count()} tasks.");
            return self::SUCCESS;
        }

        $deleted = $query->delete();
        $this->info("Deleted {$deleted} tasks.");
        return self::SUCCESS;   // 0 = ok, non-zero = failure
    }
}
```

## Signature syntax

- Argument: `{name}`, optional `{name?}`, default `{name=foo}`, array `{name*}`.
- Option flag: `{--force}`; with value `{--queue=}`; shortcut `{--Q|queue=}`.

## I/O helpers

`$this->info/warn/error/line()`, `$this->table($headers, $rows)`,
`$this->ask()`, `$this->confirm()`, `$this->choice()`, and a progress bar via
`$this->withProgressBar($items, fn ($i) => ...)`.

## Running

Manually: `php artisan tasks:prune 60 --dry-run`. On a schedule: add
`$schedule->command('tasks:prune')->daily();` in the console Kernel.

## Example

See `examples/PruneTasks.php`.

## Exercise

See `exercise.md`.
