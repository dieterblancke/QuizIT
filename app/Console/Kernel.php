<?php

namespace App\Console;

use App\Jobs\QuizitScheduleJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            $x = 60 / 3;

            while ($x-- > 0) {
                $now = Carbon::now()->addSeconds(3);
                QuizitScheduleJob::dispatch()->onQueue('schedule-queue');

                if ($now->isAfter(Carbon::now())) {
                    time_sleep_until($now->timestamp);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
