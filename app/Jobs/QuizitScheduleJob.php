<?php

namespace App\Jobs;

use App\Models\Quizit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QuizitScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "test";
        $quizits = Quizit::all();

        foreach ($quizits as $quizit) {
            if ($quizit->isRunning()) {
                $quizitInstance = $quizit->getRunningQuizit();

                QuizitTickerJob::dispatch($quizitInstance)->onQueue('ticker-queue');
            }
        }
    }
}
