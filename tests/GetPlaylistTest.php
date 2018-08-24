<?php

namespace Tests\Unit;

use App\Domain\Signage\Playlists\PlaylistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPlaylistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        factory('App\Domain\Signage\Playlists\PlaylistDefinition')->create();
        factory('App\Domain\Signage\Playlists\PlaylistDefinition')->create();

        $playlistSvc = app()->make(PlaylistService::class);
        $resolved = $playlistSvc->getAll();
        $this->assertEquals(count($resolved), 2);
    }

    public function testGetByName()
    {
        factory('App\Domain\Signage\Playlists\PlaylistDefinition')->create(['name' => 'ABCD 1234']);

        $playlistSvc = app()->make(PlaylistService::class);
        $resolved = $playlistSvc->getPlaylistDefinitionByName('ABCD 1234');
        $this->assertNotNull($resolved);
    }
}
