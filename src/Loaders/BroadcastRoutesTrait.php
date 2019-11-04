<?php


namespace Molezinha\Loaders;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Molezinha\Core\Facades\Molezinha;
use Illuminate\Support\Facades\File;

/**
 * Trait BroadcastRoutesTrait
 * @package Molezinha\Loaders
 * Use this trait in Broadcast service Provider to automatically load containers broadcast routes.
 */
trait BroadcastRoutesTrait
{
    /**
     * @param null $attributes
     * Call this function inside BrodcastServiceProvider boot method
     */
    public function loadContainerChannelsRoutes($attributes = null)
    {
        $attributes = $attributes ? : ['prefix' => 'api', 'middleware' => ['auth:api']];

        $containersPaths = Molezinha::getContainersPaths();
        $containersNamespace = Molezinha::getContainersNamespace();

        foreach ($containersPaths as $containerPath) {
            $this->loadChannels($containerPath, $containersNamespace, $attributes);
        }
    }

    private function loadChannels($containerPath, $containersNamespace, $attributes)
    {
        // build the container api routes path
        $channelRoutePath = $containerPath . '/UI/Broadcast/Routes';
        // build the namespace from the path
        $controllerNamespace = $containersNamespace . '\\Containers\\' . basename($containerPath) . '\\UI\\API\\Controllers';

        if (File::isDirectory($channelRoutePath)) {
            $files = File::allFiles($channelRoutePath);
            $files = Arr::sort($files, function ($file) {
                return $file->getFilename();
            });
            foreach ($files as $file) {
                $this->loadChannelRoute($file, $controllerNamespace, $attributes);
            }
        }
    }

    private function loadChannelRoute($file, $controllerNamespace, $attributes)
    {
        Route::group($attributes, function ($router) use ($file) {
            require $file->getPathname();
        });
    }
}
