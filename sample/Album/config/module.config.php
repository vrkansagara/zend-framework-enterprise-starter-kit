<?php

namespace Album;

use Album\Controller\AlbumController;
use Zend\Router\Http\Segment;

return [
    'db' => [
        'driver' => 'Pdo',
//        'dsn'            => 'mysql:dbname=blog;host=localhost',
        'dsn' => sprintf('sqlite:%s/data/zftutorial.db', realpath(getcwd())),
        'driver_options' => [
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'album' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => AlbumController::class,
                        'action' => 'index',
                        'page' => 1,
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
