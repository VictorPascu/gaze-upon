<?php

namespace App\Http\Controllers;

use App\Domain\Signage\Playables\PlayableItemType;
use Illuminate\Http\Request;
use App\Domain\Signage\Playables\PlayableItem;
use App\Events\PlayNewItem;

class StreamController extends Controller
{
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
}
