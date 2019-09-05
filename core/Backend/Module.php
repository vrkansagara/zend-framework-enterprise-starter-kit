<?php

namespace Backend;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    // Autoload all classes from namespace 'Test' from '/module/Test/src/Test'
                    __NAMESPACE__ => __DIR__ . '/src/',
                ]
            ]
        ];
    }
}
