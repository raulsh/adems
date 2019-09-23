<?php

namespace Raulsalamanca\Adems;

use Illuminate\Support\ServiceProvider;

use raulsalamanca\adems\Auth;
use raulsalamanca\adems\app\Console\Commands\AdemsSync;

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
        return new Auth();
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
