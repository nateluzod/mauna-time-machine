<?php

namespace App\Jobs;

// use App\Feed;
use Illuminate\Bus\Queueable;

class UpdateFromFeed
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->feed = $feed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $feeds = $feed::all()
        // copy('http://somedomain.com/file.jpeg', '/tmp/file.jpeg');
        //
        var_dump('Updating all feeds');
    }
}
