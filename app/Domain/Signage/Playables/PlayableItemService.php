<?php

namespace App\Domain\Signage\Playables;

class PlayableItemService
{
    public function resolveUrl($url)
    {
        $type = '';
        $videoId = '';

        if (strpos($url, "youtube.com") !== false) {
            $type = 'YouTube';
            $videoId = substr($url, strpos($url, "?v=") + 3);
        }

        if (strpos($url, "vimeo.com") !== false) {
            $type = 'Vimeo';
            $videoId = substr($url, strpos($url, "vimeo.com") + 10);
        }

        $type = PlayableItemType::whereType($type)->first();
        $typeId = $type->id;

        return ['path' => $url, 'type' => $type->type, 'videoId' => $videoId, 'typeId' => $typeId];
    }

    public function createPlayableItemFromUrl($url, $name, $duration)
    {
        $resolved = $this->resolveUrl($url);
        return $this->createPlayableItem($resolved['typeId'], $name, $duration, $resolved['path']);
    }

    public function createPlayableItem($typeId, $name, $duration, $path)
    {

        $playable = new PlayableItem();
        $playable->type_id = $typeId;
        $playable->name = $name;
        $playable->duration = $duration;
        $playable->path = $path;
        $playable->save();
        return $playable;
    }

    public function createPlayableItemType($type)
    {
        $itemType = new PlayableItemType();
        $itemType->type = $type;
        $itemType->save();

        return $itemType;
    }

    public function getTypeByName($name)
    {
        return PlayableItemType::where('type', $name)->first();
    }
}
