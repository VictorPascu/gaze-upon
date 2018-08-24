<?php

namespace App\Http\Controllers;

class StreamController extends Controller
{
    public function watchFeed($feedname)
    {
        return view('listener.index')->with(['feedname' => $feedname]);
    }
}
