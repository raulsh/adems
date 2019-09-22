<?php

namespace raulsalamanca\adems\Console\Commands;

use Illuminate\Console\Command;
use App\Libraries\Adems\Auth;
use App\Libraries\Adems\Sync;

class AdemsSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adems:sync {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync ADEMS data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Auth $auth, Sync $sync)
    {
      if($auth->isConnected() or $auth->login()){
        switch($this->argument('name')){
          case 'schools':
            $sync->sync('schools');
            break;
          case 'persons':
            $sync->sync('persons');
            break;
          case 'personsInfo':
            $sync->sync('personsInfo');
            break;
          case 'receivings':
            $sync->sync('receivings');
            break;
          default:
            $this->error('No valid option selected!');
        }
      }
      $this->info('Done!');
    }
}
