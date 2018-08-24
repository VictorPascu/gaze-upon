<?php

namespace App\Http\Controllers;

use App\Domain\Signage\Feeds\FeedService;
use App\Domain\Signage\Playables\PlayableItemType;
use Illuminate\Http\Request;
use App\Domain\Signage\Playables\PlayableItem;
use App\Events\PlayNewItem;

class StreamController extends Controller
{
    private $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function watchFeed($feedname)
    {
        return view('listener.index')->with(['feedname' => $feedname]);
    }

    public function playItem(Request $request) {
            $type = PlayableItemType::whereType($request['body']['type'])->first();
            $duration = $request['body']['duration'];
            $path = $request['body']['path'];
            $name = "";
            $feedname = $request['feedname'];

            return $this->feedService->playItem($type, $name, $duration, $path, $feedname);
    }
}
