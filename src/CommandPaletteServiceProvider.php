<?php

namespace IsaEken\LaravelCommandPalette;

use Illuminate\Contracts\Http\Kernel;
use IsaEken\LaravelCommandPalette\Middleware\InjectCommandPalette;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CommandPaletteServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-command-palette')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasCommands([])
            ->hasRoutes('api', 'web');
    }

    public function packageRegistered()
    {
        $this->app->singleton(CommandPalette::class, function ($app) {
            return new CommandPalette();
        });
    }

    public function bootingPackage()
    {
        $this->registerMiddleware(InjectCommandPalette::class);
    }

    /**
     * Register a middleware.
     *
     * @param  string  $middleware
     * @return void
     */
    public function registerMiddleware(string $middleware): void
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}
