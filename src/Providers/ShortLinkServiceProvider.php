<?php

declare(strict_types=1);

namespace OrlovTech\ShortLink\Providers;

use Illuminate\Support\ServiceProvider;
use OrlovTech\ShortLink\Actions\GenerateAction;

final class ShortLinkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('short-link.generate', function () {
            return new GenerateAction();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

            $this->publishes([
                __DIR__.'/../../config/short-link.php' => config_path('short-link.php'),
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }
}
