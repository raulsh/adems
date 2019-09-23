<?php

namespace Raulsalamanca\Adems;

use Illuminate\Support\ServiceProvider;

use Raulsalamanca\Adems\Auth;

use Setting, App;

class AdemsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(Auth::class, function(){
        return new Auth(
          \Config::get('adems.username'),
          \Config::get('adems.password'),
          \Config::get('adems.default_school_id'),
          \Config::get('adems.default_period_id'),
        );
      });

      $this->mergeConfigFrom(
        __DIR__ . '/config/adems.php', 'adems'
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
        __DIR__ . '/config/adems.php' => config_path('adems.php')
      ], 'config');
    }
}
