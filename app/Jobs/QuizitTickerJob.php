<?php

namespace App\Jobs;

use App\Events\QuizitTickEvent;
use App\Models\QuizitInstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use function broadcast;

class QuizitTickerJob implements ShouldQueue
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
     * @param QuizitInstance $instance
     * @return void
     */
    public function handle(QuizitInstance $instance)
    {
        broadcast(new QuizitTickEvent([
            "hello" => "world",
            "test" => "test123456",
        ]));
    }
}
