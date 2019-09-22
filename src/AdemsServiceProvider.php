<?php

namespace raulsalamanca\adems;

use Illuminate\Support\ServiceProvider;

use raulsalamanca\adems\Auth;
use raulsalamanca\adems\Config;
use raulsalamanca\adems\Console\Commands\AdemsSync;

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
      App::singleton(Config::class, function(){
        $username = Setting::get('adems.username');
        $password = Setting::get('adems.password');
        $schoolId = Setting::get('adems.default_school_id');
        $periodId = Setting::get('adems.default_period_id');

        return new Config($username, $password, $schoolId, $periodId);
      });

      App::singleton(Auth::class, function(){
        return new Auth(app(Config::class));
      });

      $this->commands([
        AdemsSyncCommand::class
      ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
