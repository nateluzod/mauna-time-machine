<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        return view("home", [
            'feeds' => \App\Feed::all()
        ]);
    }

    public function feed($slug)
    {
        return view("feed", [
            'feed' => \App\Feed::where('slug', $slug)->first()
        ]);
    }
}
