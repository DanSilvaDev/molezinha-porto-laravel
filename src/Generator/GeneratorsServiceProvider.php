<?php

namespace Molezinha\Generator;

use Molezinha\Generator\Commands\ActionGenerator;
use Molezinha\Generator\Commands\ConfigurationGenerator;
use Molezinha\Generator\Commands\ContainerApiGenerator;
use Molezinha\Generator\Commands\ContainerGenerator;
use Molezinha\Generator\Commands\ContainerWebGenerator;
use Molezinha\Generator\Commands\ControllerGenerator;
use Molezinha\Generator\Commands\EventGenerator;
use Molezinha\Generator\Commands\EventHandlerGenerator;
use Molezinha\Generator\Commands\ExceptionGenerator;
use Molezinha\Generator\Commands\JobGenerator;
use Molezinha\Generator\Commands\MailGenerator;
use Molezinha\Generator\Commands\MigrationGenerator;
use Molezinha\Generator\Commands\ModelGenerator;
use Molezinha\Generator\Commands\NotificationGenerator;
use Molezinha\Generator\Commands\ReadmeGenerator;
use Molezinha\Generator\Commands\RepositoryGenerator;
use Molezinha\Generator\Commands\RequestGenerator;
use Molezinha\Generator\Commands\RouteGenerator;
use Molezinha\Generator\Commands\SeederGenerator;
use Molezinha\Generator\Commands\ServiceProviderGenerator;
use Molezinha\Generator\Commands\SubActionGenerator;
use Molezinha\Generator\Commands\TaskGenerator;
use Molezinha\Generator\Commands\TestFunctionalTestGenerator;
use Molezinha\Generator\Commands\TestTestCaseGenerator;
use Molezinha\Generator\Commands\TestUnitTestGenerator;
use Molezinha\Generator\Commands\TransformerGenerator;
use Molezinha\Generator\Commands\TransporterGenerator;
use Molezinha\Generator\Commands\ValueGenerator;
use Illuminate\Support\ServiceProvider;

/**
 * Class GeneratorsServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GeneratorsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // all generators ordered by name
        $this->registerGenerators([
            ActionGenerator::class,
            ConfigurationGenerator::class,
            ContainerGenerator::class,
            ContainerApiGenerator::class,
            ContainerWebGenerator::class,
            ControllerGenerator::class,
            EventGenerator::class,
            EventHandlerGenerator::class,
            ExceptionGenerator::class,
            JobGenerator::class,
            MailGenerator::class,
            MigrationGenerator::class,
            ModelGenerator::class,
            NotificationGenerator::class,
            ReadmeGenerator::class,
            RepositoryGenerator::class,
            RequestGenerator::class,
            RouteGenerator::class,
            SeederGenerator::class,
            ServiceProviderGenerator::class,
            SubActionGenerator::class,
            TestFunctionalTestGenerator::class,
            TestTestCaseGenerator::class,
            TestUnitTestGenerator::class,
            TaskGenerator::class,
            TransformerGenerator::class,
            TransporterGenerator::class,
            ValueGenerator::class,
        ]);
    }

    /**
     * Register the generators.
     * @param array $classes
     */
    private function registerGenerators(array $classes)
    {
        foreach ($classes as $class) {
            $lowerClass = strtolower($class);

            $this->app->singleton("command.porto.$lowerClass", function ($app) use ($class) {
                return $app[$class];
            });

            $this->commands("command.porto.$lowerClass");
        }
    }
}
