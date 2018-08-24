<?php

namespace App\Console\Commands;

use App\Domain\Signage\Feeds\FeedService;
use App\Domain\Signage\Playables\PlayableItemService;
use App\Domain\Signage\Playlists\PlaylistService;
use App\User;
use Artisan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class InitializeDefaults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize default app settings in DB.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('migrate:refresh');

        $playableSvc = new PlayableItemService();

        $playlistSvc = new PlaylistService($playableSvc);
        $feedSvc = new FeedService($playlistSvc, $playableSvc);

        $vimeoType = $playableSvc->createPlayableItemType('Vimeo');
        $youtubeType = $playableSvc->createPlayableItemType('YouTube');

        $defaultPlaylistDef = $playlistSvc->createPlaylistDefinition('Default');
        $alternativePlaylistDef = $playlistSvc->createPlaylistDefinition('Alternative');

        $v0 = $playableSvc->createPlayableItem(
            $vimeoType->id,
            "'Olive' by Jake Chudnow [HD]",
            "180",
            "https://vimeo.com/133039680"
        );

        $v1 = $playableSvc->createPlayableItem(
            $vimeoType->id,
            "Mountains of Valais",
            "265",
            "https://vimeo.com/81082164"
        );

        $v2 = $playableSvc->createPlayableItem(
            $vimeoType->id,
            "Overlay Ink water Particles Element Composite Green Blend Sparkle - Stock video Free footage",
            "40",
            "https://vimeo.com/groups/stockfootage/videos/272002693"
        );

        $v3 = $playableSvc->createPlayableItem(
            $youtubeType->id,
            "HI-RES - Practical Model Effects with CGI elements",
            "39",
            "https://www.youtube.com/watch?v=A3fWa8yifGU"
        );

        $v4 = $playableSvc->createPlayableItem(
            $youtubeType->id,
            "Optimistic Nihilism",
            "249",
            "https://www.youtube.com/watch?v=MBRqu0YOH14"
        );

        $v5 = $playableSvc->createPlayableItem(
            $youtubeType->id,
            "The Repugnant Conclusion",
            "488",
            "https://www.youtube.com/watch?v=XTm-4O2a9dA"
        );

        $playlistSvc->createPlaylistEntry($v0->id, $defaultPlaylistDef->id, 1);
        $playlistSvc->createPlaylistEntry($v1->id, $defaultPlaylistDef->id, 2);
        $playlistSvc->createPlaylistEntry($v2->id, $defaultPlaylistDef->id, 3);
        $playlistSvc->createPlaylistEntry($v3->id, $defaultPlaylistDef->id, 4);
        $playlistSvc->createPlaylistEntry($v4->id, $alternativePlaylistDef->id, 1);
        $playlistSvc->createPlaylistEntry($v5->id, $alternativePlaylistDef->id, 2);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $feedSvc->createFeed('default', 1);
        $feedSvc->setStatus('playing', 1);
        $feedSvc->setFeedPlaylistDefinition(1, 1);
        $feedSvc->playPlaylistEntryInFeed(1, 3);

        return true;
    }
}
