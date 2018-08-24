<?php

namespace Tests\Feature;

use App\Domain\Signage\Feeds\Feed;
use App\Domain\Signage\Feeds\FeedService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FeedServiceTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function testItCreatesFeeds()
    {
        $feedName = $this->faker->name;
        $feedSvc = resolve(FeedService::class);
        $feedSvc->createFeed($feedName, 1);

        $newFeed = Feed::whereName($feedName)->first();
        $this->assertNotNull($newFeed);
    }

    public function testItSetsFeedStatus()
    {
        $feedName = $this->faker->name;
        $feedSvc = resolve(FeedService::class);
        $feed = $feedSvc->createFeed($feedName, 1);

        $status = $this->faker->name;

        $feedSvc->setStatus($status, $feed->id);

        $check = Feed::whereid($feed->id)->first();
        $this->assertEquals($check->status, $status);
    }
}
