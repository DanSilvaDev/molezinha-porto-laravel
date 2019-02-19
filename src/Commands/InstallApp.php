<?php

namespace Molezinha\Commands;

use Illuminate\Console\Command;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mol:app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      if (empty(env('APP_KEY')))
      {
        $this->call('key:generate');
      } else
      {
        $this->info('Chaves já foram geradas anteriormente!');
      }

      $this->info('Iniciando Atualização da Aplicação!');
      exec('composer install');


      $this->info('Updating Database');
      $this->call('migrate', ['--force']);
      $this->call('passport:install');

      // inspired by: https://github.com/laravel/framework/blob/5.1/src/Illuminate/Foundation/Console/KeyGenerateCommand.php#L38-L44
      if (empty(env('PASSPORT_CLIENT_SECRET')))
      {
        $key = DB::table('oauth_clients')
          ->where('password_client', '1')
          ->where('revoked', 0)
          ->first();

        $path = base_path('.env');
        if (file_exists($path))
        {
          file_put_contents($path, str_replace(
            'PASSPORT_CLIENT_SECRET=', 'PASSPORT_CLIENT_SECRET=' . $key->secret, file_get_contents($path)
          ));
          file_put_contents($path, str_replace(
            'PASSPORT_CLIENT_ID=', 'PASSPORT_CLIENT_ID=' . $key->id, file_get_contents($path)
          ));
        }
      }

      $this->call('config:clear');
      exec('composer dump-autoload');
      $this->info('Instalação Finalizada!');

    }
}
