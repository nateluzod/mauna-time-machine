<?php

namespace App\Console\Commands;

use App\Feed;
use App\Frame;
use Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Console\Command;

class UpdateFromFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var int $feed the id of the feed you want to pull from
     */
    protected $signature = 'feed:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls latest images from available feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check to see if the URL exists
     * @param  string $url the location we're checking against
     * @return boolean
     */
    public function urlExists($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if(curl_exec($ch)!==FALSE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Copies the file form the source to a temp directory
     * @param  string $source the location of the source file
     * @param  string $tmpfile the location for the temp file
     * @return void
     */
    private function copyFileFromSource($source, $tmpfile)
    {
        copy($source, $tmpfile);
    }

    /**
     * Copies the file to storage location
     * @param  string $newfile name of the file we're creating, plus dir
     * @param  string $tmpfile temp file we're pushing up yonder
     * @return void
     */
    private function pushFileToStorage($slug, $stamp, $tmpfile)
    {
        $s3 = Storage::disk('s3');
        $s3->put("{$slug}/{$stamp}.jpg", file_get_contents($tmpfile));
    }

    /**
     * Gets rid of temp file to keep server fresh and clean
     * @param  string $tmpfile file and path that we're cleaning up
     * @return void
     */
    private function cleanUpTempFile($tmpfile)
    {
        unlink($tmpfile);
    }

    /**
     * Creates the record in the DB
     * @param  int $stamp timestamp, becomes filename
     * @param  int $feed id of the feed
     * @return void
     */
    private function createDbRecord($stamp, $feed)
    {
        $frame = new \App\Frame;
        $frame->filename = $stamp;
        $frame->feed_id = $feed;
        $frame->save();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $feeds = Feed::all();
        $storage = storage_path();
        $stamp = time();
        $tmpfile = "{$storage}/tmp/{$stamp}.jpg";
        $newfile = "{$storage}/{$stamp}.jpg";
        $bar = $this->output->createProgressBar(count($feeds));

        foreach ($feeds as $feed) {
            if($this->urlExists($feed->location)) {
                $this->copyFileFromSource($feed->location, $tmpfile);
                $this->pushFileToStorage($feed->slug, $stamp, $tmpfile);
                $this->createDbRecord($stamp, $feed->id);
                $this->cleanUpTempFile($tmpfile);
            } else {
                $this->error("Feed for {$feed->title} seems broken");
            }

            $bar->advance();
        }

        $bar->finish();
    }
}
