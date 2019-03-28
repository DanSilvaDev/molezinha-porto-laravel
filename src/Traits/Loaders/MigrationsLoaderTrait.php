<?php


namespace Molezinha\Traits\Loaders;

use App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * Class MigrationsLoaderTrait.
 * from: https://github.com/apiato/core/blob/master/Loaders/MigrationsLoaderTrait.php
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait MigrationsLoaderTrait
{
  /**
   * @param $containerName
   */
  public function loadMigrationsFromContainers($containerName)
  {
    $containerMigrationDirectory = base_path('app//Containers//' . $containerName . '//Data//Migrations');
    Log::debug($containerMigrationDirectory);
    $this->loadMigrations($containerMigrationDirectory);
  }

  /**
   * @void
   */
  public function loadMigrationsFromShip()
  {
    $portMigrationDirectory = base_path('app/Ship/Migrations');
    $this->loadMigrations($portMigrationDirectory);
  }

  /**
   * @param $directory
   */
  private function loadMigrations($directory)
  {
    if (File::isDirectory($directory))
    {
      $this->loadMigrationsFrom($directory);
    }
  }
}