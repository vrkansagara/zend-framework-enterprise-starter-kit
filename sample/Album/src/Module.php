<?php

namespace Album;

use Album\Model\AlbumTable;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use function Couchbase\defaultDecoder;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\AlbumTable::class => function ($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                Model\AlbumTableGateway::class => function ($container) {
                    $configArray = $this->getConfig();
                    $dbAdapter = new Adapter($configArray['db']);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function ($container) {
                    // get service manager
                    $serviceLocator = $container->get('ServiceManager');
                    // get view helper manager
                    $viewHelperManager = $serviceLocator->get('ViewHelperManager');
                    // get 'head script' plugin
                    $footerScript = $viewHelperManager->get('inlineScript');

                    return new Controller\AlbumController(
                        $container->get(Model\AlbumTable::class),
                        $footerScript
                    );
                },
            ],
        ];
    }
}
