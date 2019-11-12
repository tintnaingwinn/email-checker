<?php

namespace Tintnaingwin\EmailChecker\Tests;

use Tintnaingwin\EmailChecker\EmailCheckerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            EmailCheckerServiceProvider::class,
        ];
    }
}
