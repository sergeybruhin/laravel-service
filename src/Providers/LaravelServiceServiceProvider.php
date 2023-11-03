<?php

namespace SergeyBruhin\LaravelService\Providers;

use Illuminate\Support\ServiceProvider;
use SergeyBruhin\LaravelService\Commands\MakeServiceCommand;

class LaravelServiceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            return false;
        }

        $this->commands(
            [
                MakeServiceCommand::class,
            ]
        );
    }


}
