<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessPodcastTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        //
    }

    public function test_job_is_dispatched()
    {
        Queue::fake();

        // Dispatch the job
     

        // Assert the job was pushed to the queue
       // Queue::assertPushed(ProcessPodcast::class);
    }
}
