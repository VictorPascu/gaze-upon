<?php

namespace App\Domain\Signage\Playables;

use Illuminate\Database\Eloquent\Model;

class PlayableItemType extends Model
{
    protected $table = "playable_item_types";
    public $timestamps = false;

    public function getId() : int
    {
        return $this->id;
    }
}
