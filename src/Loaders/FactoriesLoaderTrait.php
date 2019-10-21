<?php

namespace Molezinha\Loaders;

use App;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factory;
use Molezinha\Core\Facades\Molezinha;

/**
 * Class FactoriesLoaderTrait.
 */
trait FactoriesLoaderTrait
{

    /**
     * By default Laravel takes a shared factory directory to load from it all the factories.
     * This function just add the containers directories, not removing the original ones
     **/
    public function loadFactoriesFromContainers()
    {
        $loadersDirectory = str_replace(getcwd(), '', __DIR__);
        $newFactoriesPath = $this->buildFactoriesContainersPath();
        /** @var  $factoryClass Factory */
        $factoryClass = $this->app->make(Factory::class);
        // Load in the original Factory all the containers
        foreach ($newFactoriesPath as $index => $path)
        {
            $factoryClass->load($path);
        }
    }

    private function buildFactoriesContainersPath()
    {
        $containersFactoriesPath = '/Data/Factories/';
        $paths = [];

        foreach (Molezinha::getContainersNames() as $containerName)
        {
            $containersDirectory = base_path('app/Containers/' . $containerName . $containersFactoriesPath);
            // Check if it's a valid Directory
            if (\File::isDirectory($containersDirectory))
            {
                $paths[] = $containersDirectory;
            }
        }
        return $paths;
    }

}
