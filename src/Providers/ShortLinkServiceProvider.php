<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Providers;

use Illuminate\Support\ServiceProvider;
use OrlovTech\ShortLink\Services\LinkGenerateService;

final class ShortLinkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/short-link.php', 'short-link');

        $this->app->bind('short-link', function() {
            return new LinkGenerateService();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }
}
