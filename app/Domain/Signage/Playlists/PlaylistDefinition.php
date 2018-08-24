<?php

namespace App\Domain\Signage\Playlists;

use Illuminate\Database\Eloquent\Model;

class PlaylistDefinition extends Model
{
    protected $table = 'playlist_definitions';

    public function entries()
    {
        return $this->hasMany('App\Domain\Signage\Playlists\PlaylistEntry');
    }

    public function getItemAtPosition($position)
    {
        $entries = $this->entries()->get();

        if ($position < count($entries)) {
            return $entries[$position];
        }

        return $entries[0];
    }

    public function enqueuePlayableItem($item)
    {
        $pe = new PlaylistEntry();
        $pe->playlist_definition_id = $this->id;
        $pe->playable_item_id = $item->id;
        $pe->save();
        return $pe;
    }

    public function checkContainsPath($path)
    {
        $entries = $this->entries()->get();

        foreach ($entries as $entry) {
            if ($entry->playableItem->path == $path) {
                return true;
            }
        }

        return false;
    }
}
