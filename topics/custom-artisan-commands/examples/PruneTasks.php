<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class PruneTasks extends Command
{
    protected $signature = 'tasks:prune {days=30 : Age threshold in days}
                                        {--dry-run : Only report, do not delete}';

    protected $description = 'Delete completed tasks older than N days';

    public function handle(): int
    {
        $cutoff = now()->subDays((int) $this->argument('days'));
        $query  = Task::where('done', true)->where('updated_at', '<', $cutoff);

        if ($this->option('dry-run')) {
            $this->warn("Dry run: would delete {$query->count()} task(s).");
            return self::SUCCESS;
        }

        if (! $this->confirm("Delete {$query->count()} task(s)?", true)) {
            $this->line('Aborted.');
            return self::SUCCESS;
        }

        $this->info("Deleted {$query->delete()} task(s).");
        return self::SUCCESS;
    }
}

// Run:       php artisan tasks:prune 60 --dry-run
// Schedule:  $schedule->command('tasks:prune')->dailyAt('03:00');
