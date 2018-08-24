<?php

namespace Tests\Unit;

use App\Domain\Signage\Playlists\PlaylistService;
use Tests\TestCase;

class PlaylistEnqueueItemFromUrlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPlaylistEnqueueItemFromUrl()
    {
        $playlist = factory('App\Domain\Signage\Playlists\PlaylistDefinition')->create();
        $playlistSvc = app()->make(PlaylistService::class);

        $faker = \Faker\Factory::create();

        $type = factory('App\Domain\Signage\Playables\PlayableItemType')->create(['type' => 'YouTube']);
        $type = factory('App\Domain\Signage\Playables\PlayableItemType')->create(['type' => 'Vimeo']);

        $name = $faker->text(50);
        $duration = $faker->numberBetween(1, 60);
        $url = 'https://www.youtube.com/watch?v=GgwE94KZJ7E';

        $playlistSvc->enqueueItemFromUrl($url, $name, $duration, $playlist);

        $name2 = $faker->text(50);
        $duration2 = $faker->numberBetween(1, 60);
        $url2 = 'https://vimeo.com/177313319';

        $playlistSvc->enqueueItemFromUrl($url2, $name2, $duration2, $playlist);

        $playlist = $playlistSvc->getPlaylistDefinitionByName($playlist->name);

        $this->assertTrue($playlist->checkContainsPath($url));
        $this->assertTrue($playlist->checkContainsPath($url2));
        $this->assertFalse($playlist->checkContainsPath("random string"));
    }
}
