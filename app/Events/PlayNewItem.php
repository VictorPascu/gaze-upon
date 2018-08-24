<?php

namespace App\Events;

use App\Domain\Signage\Playables\PlayableItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayNewItem implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $targetChannel;
    public $newItem;
    public $name;
    public $type;
    public $typeId;
    public $duration;
    public $videoId;

    public function __construct(PlayableItem $newItem, $targetChannel = "global-screens")
    {
        $this->newItem = $newItem;

        $this->name = $newItem->getName();
        $this->typeId = $newItem->getType();
        $this->type = $newItem->getTypeName();
        $this->duration = $newItem->getDurationInSeconds();
        $this->videoId = $newItem->getVideoId();

        $this->targetChannel = $targetChannel;
//        if ($this->type == "VimeoVideo") {
//            $this->videoId = $newItem->id;
//        } else {
//            $this->videoId = "none";
//        }

        \Log::info('Broadcasting event to...   ' . $targetChannel);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->targetChannel);
    }
}
