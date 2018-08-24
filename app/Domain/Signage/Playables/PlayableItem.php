<?php

namespace App\Domain\Signage\Playables;

use Illuminate\Database\Eloquent\Model;

class PlayableItem extends Model implements \JsonSerializable
{
    protected $table = "playable_items";

    public function getDurationInSeconds()
    {
        return $this->duration;
    }

//    public $type;
//    public $name;
//    public $durationInSeconds;
//    public $id;
//
//    public function __construct($type, $name, $durationInSeconds, $path)
//    {
//        $this->type_id = $type;
//        $this->name = $name;
//        $this->duration = $durationInSeconds;
//        $this->path = $path;
//    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type_id;
    }

    public function getTypeName()
    {
        return PlayableItemType::whereId($this->getType())->first()->type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getVideoId()
    {
        $type = PlayableItemType::whereId($this->getType())->first();
        $path = $this->getPath();

        if ($type->type == 'Vimeo') {
            return substr($path, strrpos($path, "/") + 1);
        }

        if ($type->type == 'YouTube') {
            return substr($path, strpos($path, "?v=") + 3);
        }
    }
//
//    /**
//     * @return mixed
//     */
//    public function getDurationInSeconds()
//    {
//        return $this->durationInSeconds;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }

//    public function jsonSerialize()
//    {
//        return [
//            "id" => $this->getId(),
//            "type" => $this->getType(),
//            "name" => $this->getName(),
//            "duration" => $this->getDurationInSeconds()
//        ];
//    }
}
