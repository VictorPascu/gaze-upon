<?php

namespace App\Domain\Signage\Playlists;

use App\Domain\Signage\Playables\PlayableItemService;

class PlaylistService
{
    private $playableItemService;

    public function __construct(PlayableItemService $playableItemService)
    {
        $this->playableItemService = $playableItemService;
    }

    public function getAll()
    {
        return PlaylistDefinition::all();
    }

    public function createPlaylistDefinition($name)
    {
        $pd = new PlaylistDefinition();
        $pd->name = $name;
        $pd->save();

        return $pd;
    }

    public function checkPlaylistContainsPath(PlaylistDefinition $playlist, $path)
    {
        $entries = $playlist->entries()->get();

        foreach ($entries as $entry) {
            if ($entry->path == $path) {
                return true;
            }
        }

        return false;
    }

    public function enqueueItemFromUrl($url, $name, $duration, PlaylistDefinition $playlist)
    {
        $playable = $this->playableItemService->createPlayableItemFromUrl($url, $name, $duration);
        $playlist->enqueuePlayableItem($playable);

        // https://www.youtube.com/watch?v=yozybDXGyFA
        // https://vimeo.com/177313319

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

    public function createPlaylistEntry($playableItemId, $playlistDefinitionId, $order)
    {
        $pe = new PlaylistEntry();
        $pe->playlist_definition_id = $playlistDefinitionId;
        $pe->playable_item_id = $playableItemId;
        $pe->order = $order;
        $pe->save();
    }

    public function getPlaylistDefinitionByName($name)
    {
        return PlaylistDefinition::where('name', '=', $name)->first();
    }
}
