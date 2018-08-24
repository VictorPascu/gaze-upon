<?php

namespace App\Domain\Signage\Feeds;

use App\Domain\Signage\Playables\PlayableItem;
use App\Events\PlayNewItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = "feeds";

    public function playItem(PlayableItem $item)
    {
        $this->playable_item_now_playing_id = $item->id;
        $this->now_playing->started_at = Carbon::now();
        event(new PlayNewItem($item, $this->name));

        return true;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
