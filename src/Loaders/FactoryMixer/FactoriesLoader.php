<?php

/**
 * This files acts as the single factory php file of all the application.
 * Inside this file I am including every factory file found int he application.
 *
 * This currently only load factories from containers not form the port as it's not necessary yet!
 */

use Molezinha\Core\Facades\Molezinha;

// Default seeders directory in the container
$containersFactoriesPath = '/Data/Factories/';

// Automatically include Factory Files from all Containers to this file,
// which will be used by Laravel when dealing with Model Factories.

// Checkout the FactoriesLoaderTrait.php trait, to get an idea on how this works.
foreach (Molezinha::getContainersNames() as $containerName) {

    $containersDirectory = base_path('app/Containers/' . $containerName . $containersFactoriesPath);

    if (\File::isDirectory($containersDirectory)) {

        $files = \File::allFiles($containersDirectory);

        foreach ($files as $factoryFile) {

            if (\File::isFile($factoryFile)) {

                // Include the factory files
                include($factoryFile);

            }
        }
    }

}

/* Includes de Default Laravel Path also, not impacting existing implementations*/
$files = \File::allFiles(database_path('factories'));
foreach ($files as $factoryFile) {
    if (\File::isFile($factoryFile)) {
        // Include the factory files
        include($factoryFile);
    }
}
