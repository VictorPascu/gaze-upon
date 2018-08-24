<?php

namespace Tests\Unit;

use App\Domain\Signage\Playables\PlayableItemService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ResolveURLTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testResolveURLIsSuccessfulForYouTube()
    {
        $playableItemSvc = new PlayableItemService();
        $resolved = $playableItemSvc->resolveUrl('https://www.youtube.com/watch?v=yozybDXGyFA');
        $this->assertEquals($resolved['videoId'], 'yozybDXGyFA');
        $this->assertEquals($resolved['type'], 'YouTube');
    }

    public function testResolveURLIsSuccessfulForVimeo()
    {
        $playableItemSvc = new PlayableItemService();
        $resolved = $playableItemSvc->resolveUrl('https://vimeo.com/177313319');
        $this->assertEquals($resolved['videoId'], '177313319');
        $this->assertEquals($resolved['type'], 'Vimeo');
    }
}
