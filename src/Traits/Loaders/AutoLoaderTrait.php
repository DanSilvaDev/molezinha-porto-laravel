<?php

namespace Molezinha\Traits\Loaders;

use Illuminate\Support\Facades\Log;
use Molezinha\Core\Facades\Molezinha;

/**
 * Trait AutoLoaderTrait
 * @package Molezinha\Traits\Loaders
 *
 * Inspired by : https://github.com/apiato/core/blob/master/Loaders/AutoLoaderTrait.php
 */

trait AutoLoaderTrait
{
  use MigrationsLoaderTrait;
  use RoutesLoaderTrait;

  public function runBootLoader()
  {
    $this->loadMigrationsFromShip();

    foreach (Molezinha::getContainersNames() as $containerName )
    {
      Log::info('Identified Containers: ' . $containerName);
      $this->loadMigrationsFromContainers($containerName);
    }

    $this->runRoutesAutoLoader();
  }
}