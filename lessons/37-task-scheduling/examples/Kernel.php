<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Jobs\PruneOldTasks;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // A closure every minute
        $schedule->call(fn () => Log::info('heartbeat'))
                 ->everyMinute();

        // An artisan command, daily at 2am, never overlapping itself
        $schedule->command('tasks:prune')
                 ->dailyAt('02:00')
                 ->withoutOverlapping()
                 ->onOneServer();

        // A queued job, hourly
        $schedule->job(new PruneOldTasks)->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}

// Production: a single cron entry runs the whole schedule:
//   * * * * * cd /path-to-app && php artisan schedule:run >> /dev/null 2>&1
//
// Local testing without cron:
//   php artisan schedule:work
