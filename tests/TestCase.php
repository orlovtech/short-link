<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use OrlovTech\ShortLink\Providers\ShortLinkServiceProvider;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function getPackageProviders($app): array
    {
        return [ShortLinkServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
        ]);
    }
}
