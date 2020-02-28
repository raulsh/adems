<?php

namespace Raulsalamanca\Adems;

use Illuminate\Support\ServiceProvider;

class AdemsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Auth::class, function () {
            return new Auth(
          \Config::get('adems.username'),
          \Config::get('adems.password'),
          \Config::get('adems.default_school_id'),
          \Config::get('adems.default_period_id'),
        );
        });

        $this->mergeConfigFrom(
        __DIR__.'/adems.php', 'adems'
      );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/adems.php' => config_path('adems.php'),
        ], 'config');
    }
}
