<?php

namespace Tests;

use Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function tearDown()
    {
        parent::tearDown();
    }
}
