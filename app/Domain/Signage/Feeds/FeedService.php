<?php

namespace App\Domain\Signage\Feeds;

use App\Domain\Signage\Playables\PlayableItemService;
use App\Domain\Signage\Playlists\PlaylistDefinition;
use App\Domain\Signage\Playlists\PlaylistEntry;
use App\Domain\Signage\Playlists\PlaylistService;
use Carbon\Carbon;

class FeedService
{
    private $playlistService;
    private $playableItemService;

    public function __construct(PlaylistService $playlistSvc, PlayableItemService $playableItmSvc)
    {
        $this->playlistService = $playlistSvc;
        $this->playableItemService = $playableItmSvc;
    }

    public function createFeed($name, $userId)
    {
        $feed = new Feed();
        $feed->name = $name;
        $feed->status = 'created';
        $feed->user_id = $userId;
        $feed->playlist_definition_id = 0;
        $feed->playable_item_now_playing_id = 0;
        $feed->playable_entry_now_playing_id = 0;
        $feed->now_playing_started_at = Carbon::now();
        $feed->save();

        return $feed;
    }

    public function setStatus($status, $feedId)
    {
        $feed = Feed::find($feedId);
        $feed->status = $status;
        $feed->save();

        return $feed;
    }

    public function setFeedPlaylistDefinition($feedId, $playlistDefinitionId)
    {
        $feed = Feed::find($feedId);
        $playlistDefinition = PlaylistDefinition::find($playlistDefinitionId);

        $feed->playlist_definition_id = $playlistDefinitionId;
        $feed->playable_item_now_playing_id = $playlistDefinition->getItemAtPosition(0)->id;
        $feed->save();
    }

    public function playPlaylistEntryInFeed($feedId, $entryId)
    {
        $feed = Feed::find($feedId);
        $playlistEntry = PlaylistEntry::find($entryId);

        $feed->playable_item_now_playing_id = $playlistEntry->playableItem->id;
        $feed->playable_entry_now_playing_id = $playlistEntry->id;
        $feed->save();
    }

    public function updateFeedNowPlaying()
    {
    }

    public function deleteFeed()
    {
    }

    public function getNextItemInPlaylistForFeed(Feed $feed)
    {
        $playlist = PlaylistDefinition::where('id', $feed->playlist_definition_id)->first();
        $next = $playlist->getItemAtPosition($feed->playable_item_now_playing_id);
        return $next;
    }
}
