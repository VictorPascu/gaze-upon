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

    public function playItem(Request $request)
    {
            $type = PlayableItemType::whereType($request['body']['type'])->first();
            $duration = $request['body']['duration'];
            $path = $request['body']['path'];
            $name = "";
            $feedname = $request['feedname'];

            return $this->feedService->playItem($type, $name, $duration, $path, $feedname);
    }

    public function playPresetVideo1()
    {
        $type = PlayableItemType::whereType('Vimeo')->first();
        $name = "Vimeo 1";
        $duration = '67';
        $path = 'https://vimeo.com/156831605';
        $feedname = 'global-screens.default';

        return $this->feedService->playItem($type, $name, $duration, $path, $feedname);
    }

    public function playPresetVideo2()
    {
        $type = PlayableItemType::whereType('Vimeo')->first();
        $name = "Vimeo 2";
        $duration = '67';
        $path = 'https://vimeo.com/285779587';
        $feedname = 'global-screens.default';

        return $this->feedService->playItem($type, $name, $duration, $path, $feedname);
    }

    public function playPresetVideo3()
    {
        $type = PlayableItemType::whereType('YouTube')->first();
        $name = "YouTube 1";
        $duration = '67';
        $path = 'https://www.youtube.com/watch?v=lmc21V-zBq0';
        $feedname = 'global-screens.default';

        return $this->feedService->playItem($type, $name, $duration, $path, $feedname);
    }
}
