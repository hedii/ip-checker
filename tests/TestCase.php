<?php

namespace Hedii\IpChecker\Test;

use Hedii\IpChecker\IpCheckerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [IpCheckerServiceProvider::class];
    }
}
