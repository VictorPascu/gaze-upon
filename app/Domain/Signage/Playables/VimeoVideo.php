<?php

namespace App\Domain\Signage\Playables;

class VimeoVideo extends PlayableItem implements \JsonSerializable
{
    public $id;


    public function jsonSerialize()
    {
        return [
          "type" => $this->getType(),
          "name" => $this->getName(),
          "duration" => $this->getDurationInSeconds(),
          "path" => $this->getPath(),
        ];
    }
}
