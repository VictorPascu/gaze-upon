<?php

namespace App\Jobs;

use App\Domain\Signage\Feeds\Feed;
use App\Domain\Signage\Feeds\FeedService;
use App\Domain\Signage\Playables\PlayableItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DisplayPlayable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $feedService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    /**
     * This job will display a playable item on a feed, and trigger changing to the next item when finished.
     *
     * @return void
     */
    public function handle(PlayableItem $item, Feed $feed, $keepPlaying = false)
    {
        $feed->playItem($item, 'global-screens' . $feed->getName());

        $delayToNextEvent = now()->addSeconds($item->getDurationInSeconds());

        if ($keepPlaying) {
            PlayNextPlayable::dispatch($feed)->delay($delayToNextEvent);
        } else {
            MarkFeedFinished::dispatch($feed)->delay($delayToNextEvent);
        }
    }
}
