<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateFromFeed;
use Illuminate\Http\Request;
use Illuminate\Bus\Dispatcher;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard', [
            'feeds' => \App\Feed::paginate(10)
        ]);
    }

    public function updateFeeds()
    {
        $feeds = new UpdateFromFeed;
        $this->displatch($feeds);
    }
}
