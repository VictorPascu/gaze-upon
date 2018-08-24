<?php

namespace App\Http\Controllers;

use App\Domain\Signage\Playables\PlayableItem;
use App\Domain\Signage\Playables\PlayableItemService;
use App\Domain\Signage\Playables\PlayableItemType;
use App\Events\PlayNewItem;
use Illuminate\Http\Request;

class ScreenDisplayController extends Controller
{
    private $playableItemService;

    public function __construct(PlayableItemService $playableItemService)
    {
        $this->playableItemService = $playableItemService;
    }

    public function showControlPanel()
    {
        return view('control-panel.index');
    }

    public function resolveUrl($url)
    {
        return $this->playableItemService->resolveUrl($url);
    }

    public function enqueueItem(Request $request, $url)
    {

        $type = '';

        $videoId = '';

        if (strpos($url, "youtube.com") !== false) {
            $type = 'YouTube';
            $videoid = substr($url, strpos($url, "?v=") + 3);
        }

        if (strpos($url, "vimeo.com") !== false) {
            $type = 'Vimeo';
            $videoid = substr($url, strpos($url, "/") + 1);
        }
    }

    public function playNewItem(Request $request)
    {
        $type = PlayableItemType::whereType($request['body']['type'])->first();
        $duration = $request['body']['duration'];
        $path = $request['body']['path'];
        $name = "";
        $feedname = $request['feedname'];

        $video = new PlayableItem();

        $video->type_id = $type->getId();
        $video->name = $name;
        $video->duration = $duration;
        $video->path = $path;

        $video->save();

        $event = new PlayNewItem($video, $feedname);
        event($event);

        return response("Request successful.", 200);
    }

    public function playvideo1()
    {
        $video = new PlayableItem();

        $type = PlayableItemType::whereType('Vimeo')->first();

        $video->type_id = $type->id;
        $video->name = "Vimeo 1";
        $video->duration = '67';
        $video->path = 'https://vimeo.com/156831605';

        $video->save();

        $event = new PlayNewItem($video, 'global-screens.default');

        event($event);
    }

    public function playvideo3()
    {
        $video = new PlayableItem();

        $type = PlayableItemType::whereType('YouTube')->first();

        $video->type_id = $type->id;
        $video->name = "YT 1";
        $video->duration = '67';
        $video->path = 'https://www.youtube.com/watch?v=lmc21V-zBq0';

        $video->save();

        $event = new PlayNewItem($video, 'global-screens.default');

        event($event);
    }

    public function playvideo2()
    {
        $video = new PlayableItem();

        $type = PlayableItemType::whereType('Vimeo')->first();

        $video->type_id = $type->id;
        $video->name = "Vimeo 1";
        $video->duration = '67';
        $video->path = 'https://vimeo.com/285779587';

        $video->save();

        $event = new PlayNewItem($video, 'global-screens.default');

        event($event);
    }
}
