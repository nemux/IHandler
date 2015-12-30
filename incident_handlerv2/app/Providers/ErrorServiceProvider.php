<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class ErrorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
