<?php

namespace Encore\Wx;

use Illuminate\Filesystem\Filesystem;
use Encore\Wx\Command\Install as InstallCommand;

class ServiceProvider extends \Encore\Container\ServiceProvider
{
    public function register()
    {
        if ( ! extension_loaded('wxwidgets')) {
            dl('wxwidgets.'.PHP_SHLIB_SUFFIX);
        }

        $this->container->bind('view.composer', function() {
            $finder = new FileResourceFinder(new Filesystem, $this->app['config']['view.paths']);

            return new Manager($finder);
        });

        $this->container->bind('wx', new Widgets);

        $this->container->bind('launcher', function() {
            \wxApp::SetInstance($this->container['wx']);
            wxEntry();
        });
    }

    public function commands()
    {
        return [new InstallCommand];
    }

    public function provides()
    {
        return ['wx', 'launcher', 'view.composer', 'giml.collection'];
    }
}