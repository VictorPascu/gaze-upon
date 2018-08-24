<?php

namespace App\Domain\Signage\Playlists;

use Illuminate\Database\Eloquent\Model;

class PlaylistEntry extends Model
{
    protected $table = 'playlist_entries';

    public function playableItem()
    {
        return $this->hasOne('App\Domain\Signage\Playables\PlayableItem', 'id', 'playable_item_id');
    }

    public function playlist()
    {
        return $this->hasOne('App\Domain\Signage\Playlist\PlaylistDefinition', 'id', 'playlist_definition_id');
    }
}
