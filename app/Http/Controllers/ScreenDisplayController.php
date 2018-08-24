<?php

namespace App\Http\Controllers;

use App\Domain\Signage\Playables\PlayableItem;
use App\Domain\Signage\Playables\PlayableItemService;
use App\Domain\Signage\Playables\PlayableItemType;
use App\Events\PlayNewItem;
use Illuminate\Http\Request;

class ScreenDisplayController extends Controller
{
    private $playableItemService;

    public function __construct(PlayableItemService $playableItemService)
    {
        $this->playableItemService = $playableItemService;
    }

    public function resolveUrl($url)
    {
        return $this->playableItemService->resolveUrl($url);
    }
}
