<?php

namespace Dock\A11yCheckerLaravel;

use Dock\A11yCheckerLaravel\Services\A11yCheckerService;
use Dock\A11yCheckerLaravel\Services\Contracts\A11yCheckerServiceContract;
use Illuminate\Support\ServiceProvider;

class DockServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'a11y-checker-laravel');

        $this->app->singleton(A11yCheckerServiceContract::class, function ($app) {
            $config = $app['config']->get('a11y-checker-laravel');

            return new A11yCheckerService(
                $config['base_url'],
                $config['key'],
            );
        });

        $this->app->alias(A11yCheckerServiceContract::class, 'dock-a11y-checker-laravel');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('a11y-checker-laravel.php'),
            ], 'config');
        }
    }

    public function provides(): array
    {
        return [
            'dock-a11y-checker-laravel',
        ];
    }
}